<?php

class Smof_Fields_Upload_Field extends Smof_Fields_ParentMulti_Field{

	protected static $properties = array(
		'allow_in_fields' => array(
			'repeatable' => true,
			'group' => true
		),
		'inheritance' => false,
		'category' => 'single'
	);
	
	function obtainDefaultOptions(){
		return parent :: obtainDefaultOptions() + array(
			'default' => array( 
				'url' => '', 
				'id' => '',
				'height' => '',
				'width' => '' , 
				'sizes' => array(
					'thumbnail' =>'',
					'medium' => ''
				) 
			),
			'validate' => array(
				'url' => false,
				'width' => false,
				'height' => false,
				'id' => false,
				'sizes' => array(
					'thumbnail' => false,
					'medium' => false
				)
			)
			
		);
	}
	
	function initiateFields(){
		
		$this -> fields[ 'url' ] = $this -> args[ 'subframework' ] -> singleFieldWithoutView( 
			$this -> data[ 'url' ] ,
			array(
				'id' => 'url',
				'type' => 'text',
				'validate' => $this -> options[ 'validate' ][ 'url' ]
			),
			array(
				'subframework' => $this -> args[ 'subframework' ],
				'name' => $this -> args[ 'name' ] ,
				'id' => $this -> args[ 'id' ],
				'show_data_name' => $this -> args[ 'show_data_name' ],
				'form_field_class' => array( 'smof-field-upload-url' )
			)
		);
		
		$this -> fields[ 'width' ] = $this -> args[ 'subframework' ] -> singleFieldWithoutView( 
				$this -> data[ 'width' ] ,
				array(
					'id' => 'width',
					'type' => 'hidden',
					'validate' => $this -> options[ 'validate' ][ 'width' ]
				),
				array(
						'subframework' => $this -> args[ 'subframework' ],
						'name' => $this -> args[ 'name' ],
						'id' => $this -> args[ 'id' ],
						'show_data_name' => $this -> args[ 'show_data_name' ],
						'form_field_class' => array( 'smof-field-upload-width' )
				)
		);
		
		$this -> fields[ 'height' ] = $this -> args[ 'subframework' ] -> singleFieldWithoutView( 
				$this -> data[ 'height' ] ,
				array(
					'id' => 'height',
					'type' => 'hidden',
					'validate' => $this -> options[ 'validate' ][ 'height' ]
				),
				array(
						'subframework' => $this -> args[ 'subframework' ],
						'name' => $this -> args[ 'name' ] ,
						'id' => $this -> args[ 'id' ],
						'show_data_name' => $this -> args[ 'show_data_name' ],
						'form_field_class' =>  array( 'smof-field-upload-height' ) 
				)
			);
			
		$this -> fields[ 'id' ] = $this -> args[ 'subframework' ] -> singleFieldWithoutView( 
				$this -> data[ 'id' ] ,
				array(
					'id' => 'id',
					'type' => 'hidden',
					'validate' => $this -> options[ 'validate' ][ 'id' ]
				),
				array(
						'subframework' => $this -> args[ 'subframework' ],
						'name' => $this -> args[ 'name' ] ,
						'id' => $this -> args[ 'id' ],
						'show_data_name' => $this -> args[ 'show_data_name' ],
						'form_field_class' => array( 'smof-field-upload-id' )
				)
			);

			
			
			$this -> fields[ 'thumbnail ' ] = $this -> args[ 'subframework' ] -> singleFieldWithoutView( 
				$this -> data[ 'sizes' ][ 'thumbnail' ] ,
				array(
					'id' => 'thumbnail',
					'type' => 'hidden',
					'validate' => $this -> options[ 'validate' ][ 'sizes' ][ 'thumbnail' ]
				),
				array(
						'subframework' => $this -> args[ 'subframework' ],
						'name' => array_merge( $this -> args[ 'name' ] , array( 'sizes' ) ) ,
						'id' => array_merge( $this -> args[ 'id' ] , array( 'sizes' ) ),
						'show_data_name' => $this -> args[ 'show_data_name' ],
						'form_field_class' => array( 'smof-field-upload-sizes-thumbnail' )
				)
			);
			
				
			$this -> fields[ 'medium' ] = $this -> args[ 'subframework' ] -> singleFieldWithoutView( 
				$this -> data[ 'sizes' ][ 'medium' ] ,
				array(
					'id' => 'medium',
					'type' => 'hidden',
					'class' => array( 'smof-field-upload-sizes-medium' ),
					'validate' => $this -> options[ 'validate' ][ 'sizes' ][ 'medium' ]
				),
				array(
						
						'subframework' => $this -> args[ 'subframework' ],
						'name' => array_merge( $this -> args[ 'name' ] , array( 'sizes' ) ) ,
						'id' => array_merge( $this -> args[ 'id' ] , array( 'sizes' ) ),
						'show_data_name' => $this -> args[ 'show_data_name' ]
				)
			);
			
	}
	
	function bodyView(){
		
			foreach( $this -> fields as $field ){
				$field -> view();
			}
			
			?>
			<input type="button" class="button smof-field-upload-upload-button" value="<?php _e( "Upload" , 'smof'); ?>">
			<input type="button" class="button smof-field-upload-remove-url" value="<?php _e( "Remove" , 'smof'); ?>">
			<div class="smof-field-upload-screenshot"><?php if( !empty( $this -> data[ 'id' ] ) ){ ?><img src="<?php $screenshot_file = wp_get_attachment_image_src( $this -> data[ 'id' ], 'thumbnail', true ); echo $screenshot_file[ 0 ]; ?>"><?php } ?></div>
		<?php
	}
	
	function enqueueStyles(){

		wp_enqueue_style( 'smof-field-upload', $this -> args[ 'subframework' ] -> getUri( 'fields' ) . 'upload/field.css'  );
	
	}
	
	function enqueueScripts(){

		wp_register_script( 'smof-field-upload', $this -> args[ 'subframework' ] -> getUri( 'fields' ) . 'upload/script.js', array( 'jquery' ) );
		wp_enqueue_script( 'smof-field-upload' );
	
	}

}

?>