INDX( 	 b�\           (   �  �            ��  f         ��    X F     �    ��<���f��<���f��<���f��<���                        0 1 f ��    X F     �    6�>����>����>����>���                        0 2 f �L   	 X F     �    ��9����?�=����?�=����?�=���                        0 4 f �    X F     �    �tX>���J�]>���J�]>���J�]>���                        0 5 f �L    X F     �    B	,:������=������=������=���                        0 7 f ��    X F     �    w?p<����ls<����ls<����ls<���                        0 8 f r�    X F     �    �r(<����],<����],<����],<���                        0 9 f TM    X F     �    ��D;���Ɖ�>���Ɖ�>���Ɖ�>���                        0 b f 0�    X F     �    ���>���}��>���}��>���}��>���                        0 c f wM    X F     �    ��;������;������;������;���                        0 f f #�    X F     �    |�>������>������>������>���                       1 3 f }�    X F     �    ��D<����H<����H<����H<���                        1 4 f M    X F     �    5��:����>����>����>���                        1 5 f #M    X F     �    M��:���.�>���.�>���.�>���                        1 7 f n�    X F     �    �<���� <���� <���� <���                        1 9 f �L   	 X F     �    �j�9����A�9����A�9����A�9���                        1 a f x�    X F     �    ��6<���Z�;<���Z�;<���Z�;<���                       1 b f ��    X F     �    TA>���z>���z>���z>���                        1 c f ��    X F     �    �k=�����=�����=�����=���                        1 d f 'M    X F     �    ❹:����:����:����:���                        1 e f -M    X F     �    ���:������:������:������:���                        1 f f C�    X F     �    �?���x?���x?���x?���                        2 0 f RM    X F     �    H�?;���6�>���6�>�� 6�>���                        2 1 f ǥ    X F     �    �i=���0Un=���0Un=���0Un=���                        2 2 f ߥ    X F     �    ̡�=������>������>������>���                        2 4 f ��    X F     �    pI=���UB�=���UB�=���UB�=���                        2 5 f ��    X F     �    ��<���F!�<���F!�<���F!�<���                        2 6 f ��    X F     �    ��=���'�3=���'�3=���'�3=���                        2 8 f �L   	 X F     �    �b�5�� �e�5����e�5����e�5���                        2 a f �L   	 X F     �    �3D5���w�>���w�>���w�>���                        2 b f M    X F     �    <:���e�>:���e�>:���e�>:���                        2 c f �L   	 X F     �    ���5���E��>���E��>���E��>���                        2 d f JM    X F     �    L�;���$';���$';���$';���                        2 e f lM    X F     �    �f�;���a�;���a�;���a�;���                        2 f f M    X F    �    tvP:���K�Y:���K�Y:���K�Y:���                        3 2 f !�    X F     �    =��>������>������>������>���                        3 4 f )M    X F     �    77�:��� h�:��� h�:��� h�:���                        3 6 f ��    X F     �    �d(=����c-=����c-=����c-=���                        3 8 f M    X F     �    �S�:���9XD=���9XD=���9XD=���                        3 a f uM    X F     �    ���;������<������<������<���                        3 b  t�    X F     �    �,<���,7�>���,7�>���,7�>���                        3 c f �L   	 X F     �    <��9���Kn;���Kn;���Kn;���                        3 e f /M    X F     �    ���:����tk>����tk>����tk>���                        3 f f �L    X F     �    J�":����=����=����=���                        4 1 f �L   	 X F     �    �)�9�����p:�����p:�����p:���                        4 2 f                                                                    nvert from array)
		$field['choices'] = acf_encode_choices($field['choices']);
		
		
		// choices
		acf_render_field_setting( $field, array(
			'label'			=> __('Choices','acf'),
			'instructions'	=> __('Enter each choice on a new line.','acf') . '<br /><br />' . __('For more control, you may specify both a value and label like this:','acf'). '<br /><br />' . __('red : Red','acf'),
			'type'			=> 'textarea',
			'name'			=> 'choices',
		));
		
		
		// allow_null
		acf_render_field_setting( $field, array(
			'label'			=> __('Allow Null?','acf'),
			'instructions'	=> '',
			'name'			=> 'allow_null',
			'type'			=> 'true_false',
			'ui'			=> 1,
		));
		
		
		// other_choice
		acf_render_field_setting( $field, array(
			'label'			=> __('Other','acf'),
			'instructions'	=> '',
			'name'			=> 'other_choice',
			'type'			=> 'true_false',
			'ui'			=> 1,
			'message'		=> __("Add 'other' choice to allow for custom values", 'acf'),
		));
		
		
		// save_other_choice
		acf_render_field_setting( $field, array(
			'label'			=> __('Save Other','acf'),
			'instructions'	=> '',
			'name'			=> 'save_other_choice',
			'type'			=> 'true_false',
			'ui'			=> 1,
			'message'		=> __("Save 'other' values to the field's choices", 'acf'),
			'conditions'	=> array(
				'field'		=> 'other_choice',
				'operator'	=> '==',
				'value'		=> 1
			)
		));
		
		
		// default_value
		acf_render_field_setting( $field, array(
			'label'			=> __('Default Value','acf'),
			'instructions'	=> __('Appears when creating a new post','acf'),
			'type'			=> 'text',
			'name'			=> 'default_value',
		));
		
		
		// layout
		acf_render_field_setting( $field, array(
			'label'			=> __('Layout','acf'),
			'instructions'	=> '',
			'type'			=> 'radio',
			'name'			=> 'layout',
			'layout'		=> 'horizontal', 
			'choices'		=> array(
				'vertical'		=> __("Vertical",'acf'), 
				'horizontal'	=> __("Horizontal",'acf')
			)
		));
		
		
		// return_format
		acf_render_field_setting( $field, array(
			'label'			=> __('Return Value','acf'),
			'instructions'	=> __('Specify the returned value on front end','acf'),
			'type'			=> 'radio',
			'name'			=> 'return_format',
			'layout'		=> 'horizontal',
			'choices'		=> array(
				'value'			=> __('Value','acf'),
				'label'			=> __('Label','acf'),
				'array'			=> __('Both (Array)','acf')
			)
		));
		
	}
	
	
	/*
	*  update_field()
	*
	*  This filter is appied to the $field before it is saved to the database
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$field - the field array holding all the field options
	*  @param	$post_id - the field group ID (post_type = acf)
	*
	*  @return	$field - the modified field
	*/

	function update_field( $field ) {
		
		// decode choices (convert to array)
		$field['choices'] = acf_decode_choices($field['choices']);
		
		
		// return
		return $field;
	}
	
	
	/*
	*  update_value()
	*
	*  This filter is appied to the $value before it is updated in the db
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*  @todo	Fix bug where $field was found via json and has no ID
	*
	*  @param	$value - the value which will be saved in the database
	*  @param	$post_id - the $post_id of which the value will be saved
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$value - the modified value
	*/
	
	function update_value( $value, $post_id, $field ) {
		
		// bail early if no value (allow 0 to be saved)
		if( !$value && !is_numeric($value) ) return $value;
		
		
		// save_other_choice
		if( $field['save_other_choice'] ) {
			
			// value isn't in choices yet
			if( !isset($field['choices'][ $value ]) ) {
				
				// get raw $field (may have been changed via repeater field)
				// if field is local, it won't have an ID
				$selector = $field['ID'] ? $field['ID'] : $field['key'];
				$field = acf_get_field( $selector, true );
				
				
				// bail early if no ID (JSON only)
				if( !$field['ID'] ) return $value;
				
				
				// unslash (fixes serialize single quote issue)
				$value = wp_unslash($value);
				
				
				// sanitize (remove tags)
				$value = sanitize_text_field($value);
				
				
				// update $field
				$field['choices'][ $value ] = $value;
				
				
				// save
				acf_update_field( $field );
				
			}
			
		}		
		
		
		// return
		return $value;
	}
	
	
	/*
	*  load_value()
	*
	*  This filter is appied to the $value after it is loaded from the db
	*
	*  @type	filter
	*  @since	5.2.9
	*  @date	23/01/13
	*
	*  @param	$value - the value found in the database
	*  @param	$post_id - the $post_id from which the value was loaded from
	*  @param	$field - the field array holding all the field options
	*
	*  @return	$value - the value to be saved in te database
	*/
	
	function load_value( $value, $post_id, $field ) {
		
		// must be single value
		if( is_array($value) ) {
			
			$value = array_pop($value);
			
		}
		
		
		// return
		return $value;
		
	}
	
	
	/*
	*  translate_field
	*
	*  This function will translate field settings
	*
	*  @type	function
	*  @date	8/03/2016
	*  @since	5.3.2
	*
	*  @param	$field (array)
	*  @return	$field
	*/
	
	function translate_field( $field ) {
		
		return acf_get_field_type('select')->translate_field( $field );
		
	}
	
	
	/*
	*  format_value()
	*
	*  This filter is appied to the $value after it is loaded from the db and before it is returned to the template
	*
	*  @type	filter
	*  @since	3.6
	*  @date	23/01/13
	*
	*  @param	$value (mixed) the value which was loaded from the database
	*  @param	$post_id (mixed) the $post_id from which the value was loaded
	*  @param	$field (array) the field array holding all the field options
	*
	*  @return	$value (mixed) the modified value
	*/
	
	function format_value( $value, $post_id, $field ) {
		
		return acf_get_field_type('select')->format_value( $value, $post_id, $field );
		
	}
	
}


// initialize
acf_register_field_type( 'acf_field_radio' );

endif; // class_exists check

?>