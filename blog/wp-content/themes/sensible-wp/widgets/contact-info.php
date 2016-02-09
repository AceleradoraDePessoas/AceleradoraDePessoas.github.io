<?php


class sensiblewp_Contact_Info extends WP_Widget { 



// constructor

    function sensiblewp_contact_info() {  

		$widget_ops = array('classname' => 'sensiblewp_contact_info_widget', 'description' => __( 'Display your contact info', 'sensible-wp') );

        parent::WP_Widget(false, $name = __('MT: Contact Info Widget', 'sensible-wp'), $widget_ops);

		$this->alt_option_name = 'sensiblewp_contact_info';

		

		add_action( 'save_post', array($this, 'flush_widget_cache') ); 

		add_action( 'deleted_post', array($this, 'flush_widget_cache') );

		add_action( 'switch_theme', array($this, 'flush_widget_cache') );		

    }

	

	// widget form creation

	function form($instance) {



	// Check values

		$title    = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';

		$address  = isset( $instance['address'] ) ? esc_html( $instance['address'] ) : '';

		$phone    = isset( $instance['phone'] ) ? esc_html( $instance['phone'] ) : '';

		$email    = isset( $instance['email'] ) ? esc_html( $instance['email'] ) : '';

	?>



	<p>

	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'sensible-wp'); ?></label>

	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /> 

	</p>



	<p><label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e( 'Enter your address', 'sensible-wp' ); ?></label>

	<input class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" type="text" value="<?php echo esc_html( $address ); ?>" size="3" /></p>



	<p><label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e( 'Enter your phone number', 'sensible-wp' ); ?></label>

	<input class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" type="text" value="<?php echo esc_html( $phone ); ?>" size="3" /></p>



	<p><label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'Enter your email address', 'sensible-wp' ); ?></label>

	<input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo esc_html( $email ); ?>" size="3" /></p>



	<?php

	}



	// update widget

	function update($new_instance, $old_instance) {

		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);

		$instance['address'] = strip_tags($new_instance['address']);

		$instance['phone'] = strip_tags($new_instance['phone']);

		$instance['email'] = sanitize_email($new_instance['email']);

		$this->flush_widget_cache();



		$alloptions = wp_cache_get( 'alloptions', 'options' );

		if ( isset($alloptions['sensiblewp_contact_info']) )

			delete_option('sensiblewp_contact_info');		  

		  

		return $instance;

	}

	

	function flush_widget_cache() {

		wp_cache_delete('sensiblewp_contact_info', 'widget');

	}

	

	// display widget

	function widget($args, $instance) {

		$cache = array();

		if ( ! $this->is_preview() ) {

			$cache = wp_cache_get( 'sensiblewp_contact_info', 'widget' );

		}



		if ( ! is_array( $cache ) ) {

			$cache = array();

		}



		if ( ! isset( $args['widget_id'] ) ) {

			$args['widget_id'] = $this->id;

		}



		if ( isset( $cache[ $args['widget_id'] ] ) ) {

			echo $cache[ $args['widget_id'] ];

			return;

		}



		ob_start();

		extract($args);



		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Contact info', 'sensible-wp' );

		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$address   = isset( $instance['address'] ) ? esc_html( $instance['address'] ) : '';

		$phone   = isset( $instance['phone'] ) ? esc_html( $instance['phone'] ) : '';

		$email   = isset( $instance['email'] ) ? esc_html( $instance['email'] ) : '';



		echo $before_widget;

		

		if ( $title ) echo $before_title . $title . $after_title;

		

		if( ($address) ) {

			echo '<div class="contact-address">';

			echo '<span>' . __('Address: ', 'sensible-wp') . '</span>' . $address;

			echo '</div>';

		}

		if( ($phone) ) {

			echo '<div class="contact-phone">';

			echo '<span>' . __('Phone: ', 'sensible-wp') . '</span>' . $phone;

			echo '</div>';

		}

		if( ($email) ) {

			echo '<div class="contact-email">';

			echo '<span>' . __('Email: ', 'sensible-wp') . '</span>' . '<a href="mailto:' . $email . '">' . $email . '</a>';

			echo '</div>'; 

		}



		echo $after_widget;





		if ( ! $this->is_preview() ) {

			$cache[ $args['widget_id'] ] = ob_get_flush();

			wp_cache_set( 'sensiblewp_contact_info', $cache, 'widget' );

		} else {

			ob_end_flush();

		}

	}

	

}	