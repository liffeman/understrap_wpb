wp.domReady(() => {
	//unregister button styles
	wp.blocks.unregisterBlockStyle('core/button', 'fill');
	wp.blocks.unregisterBlockStyle('core/button', 'outline');

	// register button styles
	wp.blocks.registerBlockStyle( 'core/button', {
		name: 'btn-normal',
		label: __( 'Normal', 'understrap' ),
		isDefault: true,
	} );
	wp.blocks.registerBlockStyle( 'core/button', {
		name: 'btn-normal-outline',
		label: __( 'Normal Outine', 'understrap' ),
	} );
	wp.blocks.registerBlockStyle( 'core/button', {
		name: 'btn-large',
		label: __( 'Large', 'understrap' ),
	} );
	wp.blocks.registerBlockStyle( 'core/button', {
		name: 'btn-large-outline',
		label: __( 'Large Outline', 'understrap' ),
	} );
	wp.blocks.registerBlockStyle( 'core/button', {
		name: 'btn-sm',
		label: __( 'Small', 'understrap' ),
	} );
	wp.blocks.registerBlockStyle( 'core/button', {
		name: 'btn-sm-outline',
		label: __( 'Small Outline', 'understrap' ),
	} );

	//register cover style
	wp.blocks.registerBlockStyle( 'core/cover', 	{
		name: 'hero-header',
		label: __('Hero', 'understrap'),
		inline_style: '.is-style-hero',
	} );

	//register group style
	wp.blocks.registerBlockStyle( 'core/group', 	{
		name: 'section',
		label: __('Section', 'understrap'),
		isDefault: true,
	} );

} );
