<?php if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Tripgo_Elementor_Gallery_Slide
 */
if ( !class_exists( 'Tripgo_Elementor_Gallery_Slide', false ) ) {

	class Tripgo_Elementor_Gallery_Slide extends \Elementor\Widget_Base {

		/**
		 * Get widget name
		 */
		public function get_name() {
			return 'tripgo_elementor_gallery_slide';
		}

		/**
		 * Get widget title
		 */
		public function get_title() {
			return esc_html__( 'Gallery Slide', 'tripgo' );
		}

		/**
		 * Get widget icon
		 */
		public function get_icon() {
			return 'eicon-slider-album';
		}

		/**
		 * Get widget categories
		 */
		public function get_categories() {
			return [ 'tripgo' ];
		}

		/**
		 * Get script depends
		 */
		public function get_script_depends() {
			return [ 'tripgo-elementor-gallery-slide' ];
		}
		
		/**
		 * Register controls
		 */
		protected function register_controls() {

			$this->start_controls_section(
				'section_content',
				[
					'label' => esc_html__( 'Content', 'tripgo' ),
				]
			);	

				$this->add_control(
					'template',
					[
						'label' 	=> esc_html__( 'Template', 'tripgo' ),
						'type' 		=> \Elementor\Controls_Manager::SELECT,
						'default' 	=> 'template1',
						'options' 	=> [
							'template1' => esc_html__( 'Template 1', 'tripgo' ),
							'template2' => esc_html__( 'Template 2', 'tripgo' ),
						]
					]
				);

				$this->add_control(
					'show_icon',
					[
						'label' 		=> esc_html__( 'Show Icon', 'tripgo' ),
						'type' 			=> \Elementor\Controls_Manager::SWITCHER,
						'label_on' 		=> esc_html__( 'Show', 'tripgo' ),
						'label_off' 	=> esc_html__( 'Hide', 'tripgo' ),
						'return_value' 	=> 'yes',
						'default' 		=> 'yes',
					]
				);
				
				// Repeater
				$repeater = new \Elementor\Repeater();

				$repeater->add_control(
					'link',
					[
						'label' 		=> esc_html__( 'Link', 'tripgo' ),
						'type' 			=> \Elementor\Controls_Manager::URL,
						'dynamic' 		=> [
							'active' => true,
						],
						'placeholder' 	=> esc_html__( 'https://your-link.com', 'tripgo' ),
						'show_label' 	=> true,
						'default' 		=> [
							'url' => '#',
						],
					]
				);

				$repeater->add_control(
					'image',
					[
						'label'   => esc_html__( 'Choose Image', 'tripgo' ),
						'type'    => \Elementor\Controls_Manager::MEDIA,
						'default' => [
							'url' => \Elementor\Utils::get_placeholder_image_src(),
						],
					]
				);

				$repeater->add_control(
					'title',
					[
						'label' 	=> esc_html__( 'Title', 'tripgo' ),
						'type' 		=> \Elementor\Controls_Manager::TEXT,
						'default' 	=> esc_html__( 'Children Park', 'tripgo' ),
					]
				);

				$repeater->add_control(
					'category',
					[
						'label' 	=> esc_html__( 'Category', 'tripgo' ),
						'type' 		=> \Elementor\Controls_Manager::TEXT,
						'default' 	=> esc_html__( 'Favorite place', 'tripgo' ),
					]
				);

				$this->add_control(
					'tab_item',
					[
						'label'		=> esc_html__( 'Tabs', 'tripgo' ),
						'type'		=> \Elementor\Controls_Manager::REPEATER,
						'fields'  	=> $repeater->get_controls(),
						'default' 	=> [
							[
								'title' => esc_html__('Children Park', 'tripgo'),
							],
							[
								'title' => esc_html__('Metro Stations', 'tripgo'),
							],
							[
								'title' => esc_html__('Historical Building', 'tripgo'),
							],
							[
								'title' => esc_html__('New York City Museum', 'tripgo'),
							],
							[
								'title' => esc_html__('The Bund', 'tripgo'),
							],
						],
					]
				);

			$this->end_controls_section();

			// Additional Options
			$this->start_controls_section(
				'section_additional_options',
				[
					'label' => esc_html__( 'Additional Options', 'tripgo' ),
				]
			);

				$this->add_control(
					'margin_items',
					[
						'label'   => esc_html__( 'Margin Right Items', 'tripgo' ),
						'type'    => \Elementor\Controls_Manager::NUMBER,
						'default' => 30,
					]
					
				);

				$this->add_control(
					'stagePadding',
					[
						'label'   => esc_html__( 'Stage Padding', 'tripgo' ),
						'type'    => \Elementor\Controls_Manager::NUMBER,
						'default' => 0,
					]
					
				);

				$this->add_control(
					'item_number',
					[
						'label'       => esc_html__( 'Item Number', 'tripgo' ),
						'type'        => \Elementor\Controls_Manager::NUMBER,
						'description' => esc_html__( 'Number Item', 'tripgo' ),
						'default'     => 3,
					]
				);

				$this->add_control(
					'slides_to_scroll',
					[
						'label'       => esc_html__( 'Slides to Scroll', 'tripgo' ),
						'type'        => \Elementor\Controls_Manager::NUMBER,
						'description' => esc_html__( 'Set how many slides are scrolled per swipe.', 'tripgo' ),
						'default'     => 1,
					]
				);

				$this->add_control(
					'pause_on_hover',
					[
						'label'   => esc_html__( 'Pause on Hover', 'tripgo' ),
						'type'    => \Elementor\Controls_Manager::SWITCHER,
						'default' => 'yes',
						'options' => [
							'yes' => esc_html__( 'Yes', 'tripgo' ),
							'no'  => esc_html__( 'No', 'tripgo' ),
						],
						'frontend_available' => true,
					]
				);


				$this->add_control(
					'infinite',
					[
						'label'   => esc_html__( 'Infinite Loop', 'tripgo' ),
						'type'    => \Elementor\Controls_Manager::SWITCHER,
						'default' => 'yes',
						'options' => [
							'yes' => esc_html__( 'Yes', 'tripgo' ),
							'no'  => esc_html__( 'No', 'tripgo' ),
						],
						'frontend_available' => true,
					]
				);

				$this->add_control(
					'autoplay',
					[
						'label'   => esc_html__( 'Autoplay', 'tripgo' ),
						'type'    => \Elementor\Controls_Manager::SWITCHER,
						'default' => 'yes',
						'options' => [
							'yes' => esc_html__( 'Yes', 'tripgo' ),
							'no'  => esc_html__( 'No', 'tripgo' ),
						],
						'frontend_available' => true,
					]
				);

				$this->add_control(
					'autoplay_speed',
					[
						'label'     => esc_html__( 'Autoplay Speed', 'tripgo' ),
						'type'      => \Elementor\Controls_Manager::NUMBER,
						'default'   => 3000,
						'step'      => 500,
						'condition' => [
							'autoplay' => 'yes',
						],
						'frontend_available' => false,
					]
				);

				$this->add_control(
					'smartspeed',
					[
						'label'   => esc_html__( 'Smart Speed', 'tripgo' ),
						'type'    => \Elementor\Controls_Manager::NUMBER,
						'default' => 500,
					]
				);

				$this->add_control(
					'dot_control',
					[
						'label'   => esc_html__( 'Show Dots', 'tripgo' ),
						'type'    => \Elementor\Controls_Manager::SWITCHER,
						'default' => 'yes',
						'options' => [
							'yes' => esc_html__( 'Yes', 'tripgo' ),
							'no'  => esc_html__( 'No', 'tripgo' ),
						],
						'frontend_available' => true,
					]
				);

			$this->end_controls_section(); // END SECTION ADDITIONAL
	        
	        $this->start_controls_section(
				'section_gallery_slide',
				[
					'label' => esc_html__( 'Image', 'tripgo' ),
					'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);
	            
	            $this->add_responsive_control(
					'image_border_radius',
					[
						'label'      => esc_html__( 'Border Radius', 'tripgo' ),
						'type'       => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
						'selectors'  => [
							'{{WRAPPER}} .ova-gallery-slide .gallery-slide-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_responsive_control(
					'image_height',
					[
						'label' 	=> esc_html__( 'Height', 'tripgo' ),
						'type' 		=> \Elementor\Controls_Manager::SLIDER,
						'range' 	=> [
							'px' => [
								'min' => 380,
								'max' => 600,
							],
						],
						'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
						'selectors' 	=> [
							'{{WRAPPER}} .ova-gallery-slide .gallery-slide-img img' => 'height: {{SIZE}}{{UNIT}};',
						],
					]
				);

				$this->add_control(
					'image_overlay_color',
					[
						'label'     => esc_html__( 'Overlay Color (Hover)', 'tripgo' ),
						'type'      => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-gallery-slide .gallery-slide-img .overlay' => 'background-color : {{VALUE}};',
						],
					]
				);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_title',
				[
					'label' => esc_html__( 'Title', 'tripgo' ),
					'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name'     => 'title_typography',
						'selector' => '{{WRAPPER}} .ova-gallery-slide .gallery-slide-img .info .title',
					]
				);

				$this->add_control(
					'title_color',
					[
						'label'     => esc_html__( 'Color', 'tripgo' ),
						'type'      => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-gallery-slide .gallery-slide-img .info .title' => 'color : {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'title_bgcolor',
					[
						'label'     => esc_html__( 'Background Color', 'tripgo' ),
						'type'      => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-gallery-slide .gallery-slide-img .info .title' => 'background-color : {{VALUE}};',
						],
					]
				);

				$this->add_responsive_control(
					'title_padding',
					[
						'label'      => esc_html__( 'Padding', 'tripgo' ),
						'type'       => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
						'selectors'  => [
							'{{WRAPPER}} .ova-gallery-slide .gallery-slide-img .info .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

			$this->end_controls_section();

			$this->start_controls_section(
				'section_category',
				[
					'label' => esc_html__( 'Category', 'tripgo' ),
					'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

				$this->add_group_control(
					\Elementor\Group_Control_Typography::get_type(),
					[
						'name'     => 'category_typography',
						'selector' => '{{WRAPPER}} .ova-gallery-slide .gallery-slide-img .info .category',
					]
				);

				$this->add_control(
					'category_color',
					[
						'label'     => esc_html__( 'Color', 'tripgo' ),
						'type'      => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-gallery-slide .gallery-slide-img .info .category' => 'color : {{VALUE}};',
							'{{WRAPPER}} .ova-gallery-slide .gallery-slide-img .info .category:before, {{WRAPPER}} .ova-gallery-slide .gallery-slide-img .info .category:after' => 'background-color : {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'category_bgcolor',
					[
						'label'     => esc_html__( 'Background Color', 'tripgo' ),
						'type'      => \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-gallery-slide .gallery-slide-img .info .category' => 'background-color : {{VALUE}};',
						],
					]
				);

				$this->add_responsive_control(
					'category_padding',
					[
						'label'      => esc_html__( 'Padding', 'tripgo' ),
						'type'       => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
						'selectors'  => [
							'{{WRAPPER}} .ova-gallery-slide .gallery-slide-img .info .category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

			$this->end_controls_section();

			// Icon
			$this->start_controls_section(
				'section_icon_style',
				[
					'label' => esc_html__( 'Icon', 'tripgo' ),
					'tab' 	=> \Elementor\Controls_Manager::TAB_STYLE,
				]
			);

				$this->add_control(
					'icon_normal_color',
					[
						'label' 	=> esc_html__( 'Color', 'tripgo' ),
						'type' 		=> \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-gallery-slide .gallery-slide-img .view-detail' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_control(
					'icon_hover_color',
					[
						'label' 	=> esc_html__( 'Color Hover', 'tripgo' ),
						'type' 		=> \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-gallery-slide .gallery-slide-img .view-detail:hover' => 'color: {{VALUE}}',
						],
					]
				);

				$this->add_control(
					'icon_normal_bgcolor',
					[
						'label' 	=> esc_html__( 'Background Color', 'tripgo' ),
						'type' 		=> \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-gallery-slide .gallery-slide-img .view-detail' => 'background-color: {{VALUE}}',
						],
					]
				);

				$this->add_control(
					'icon_hover_bgcolor',
					[
						'label' 	=> esc_html__( 'Background Color Hover', 'tripgo' ),
						'type' 		=> \Elementor\Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .ova-gallery-slide .gallery-slide-img .view-detail:hover' => 'background-color: {{VALUE}}',
						],
					]
				);

			$this->end_controls_section();

	        /* Begin Dots Style */
			$this->start_controls_section(
	            'dots_style',
	            [
	                'label' 	=> esc_html__( 'Dots', 'tripgo' ),
	                'tab' 		=> \Elementor\Controls_Manager::TAB_STYLE,
	                'condition' => [
						'dot_control' => 'yes',
					]
	            ]
	        );

	            $this->add_responsive_control(
					'dots_margin',
					[
						'label'      => esc_html__( 'Margin', 'tripgo' ),
						'type'       => \Elementor\Controls_Manager::DIMENSIONS,
						'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
						'selectors'  => [
							'{{WRAPPER}} .ova-gallery-slide .owl-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->start_controls_tabs( 'tabs_dots_style' );
					
					$this->start_controls_tab(
			            'tab_dots_normal',
			            [
			                'label' => esc_html__( 'Normal', 'tripgo' ),
			            ]
			        );

			            $this->add_control(
							'dot_color',
							[
								'label' 	=> esc_html__( 'Color', 'tripgo' ),
								'type' 		=> \Elementor\Controls_Manager::COLOR,
								'selectors' => [
									'{{WRAPPER}} .ova-gallery-slide .owl-dots .owl-dot span' => 'background-color: {{VALUE}}',
								],
							]
						);

						$this->add_responsive_control(
							'dots_width',
							[
								'label' 	=> esc_html__( 'Width', 'tripgo' ),
								'type' 		=> \Elementor\Controls_Manager::SLIDER,
								'range' 	=> [
									'px' => [
										'min' => 0,
										'max' => 100,
									],
								],
								'size_units' 	=> [ 'px' ],
								'selectors' 	=> [
									'{{WRAPPER}} .ova-gallery-slide .owl-dots .owl-dot span' => 'width: {{SIZE}}{{UNIT}};',
								],
							]
						);

						$this->add_responsive_control(
							'dots_height',
							[
								'label' 	=> esc_html__( 'Height', 'tripgo' ),
								'type' 		=> \Elementor\Controls_Manager::SLIDER,
								'range' 	=> [
									'px' => [
										'min' => 0,
										'max' => 100,
									],
								],
								'size_units' 	=> [ 'px' ],
								'selectors' 	=> [
									'{{WRAPPER}} .ova-gallery-slide .owl-dots .owl-dot span' => 'height: {{SIZE}}{{UNIT}};',
								],
							]
						);

						$this->add_control(
				            'dots_border_radius',
				            [
				                'label' 		=> esc_html__( 'Border Radius', 'tripgo' ),
				                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				                'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				                'selectors' 	=> [
				                    '{{WRAPPER}} .ova-gallery-slide .owl-dots .owl-dot span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				                ],
				            ]
				        );

			        $this->end_controls_tab();

			        $this->start_controls_tab(
			            'tab_dots_active',
			            [
			                'label' => esc_html__( 'Active', 'tripgo' ),
			            ]
			        );

			             $this->add_control(
							'dot_color_active',
							[
								'label' 	=> esc_html__( 'Color', 'tripgo' ),
								'type' 		=> \Elementor\Controls_Manager::COLOR,
								'selectors' => [
									'{{WRAPPER}} .ova-gallery-slide .owl-dots .owl-dot.active span' => 'background-color: {{VALUE}}',
								],
							]
						);

						$this->add_responsive_control(
							'dots_width_active',
							[
								'label' 	=> esc_html__( 'Width', 'tripgo' ),
								'type' 		=> \Elementor\Controls_Manager::SLIDER,
								'range' 	=> [
									'px' => [
										'min' => 0,
										'max' => 100,
									],
								],
								'size_units' 	=> [ 'px' ],
								'selectors' 	=> [
									'{{WRAPPER}} .ova-gallery-slide .owl-dots .owl-dot.active span' => 'width: {{SIZE}}{{UNIT}};',
								],
							]
						);

						$this->add_responsive_control(
							'dots_height_active',
							[
								'label' 	=> esc_html__( 'Height', 'tripgo' ),
								'type' 		=> \Elementor\Controls_Manager::SLIDER,
								'range' 	=> [
									'px' => [
										'min' => 0,
										'max' => 100,
									],
								],
								'size_units' 	=> [ 'px' ],
								'selectors' 	=> [
									'{{WRAPPER}} .ova-gallery-slide .owl-dots .owl-dot.active span' => 'height: {{SIZE}}{{UNIT}};',
								],
							]
						);

						$this->add_control(
				            'dots_border_radius_active',
				            [
				                'label' 		=> esc_html__( 'Border Radius', 'tripgo' ),
				                'type' 			=> \Elementor\Controls_Manager::DIMENSIONS,
				                'size_units' 	=> [ 'px', '%', 'em', 'rem', 'custom' ],
				                'selectors' 	=> [
				                    '{{WRAPPER}} .ova-gallery-slide .owl-dots .owl-dot.active span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				                ],
				            ]
				        );

			        $this->end_controls_tab();
				$this->end_controls_tabs();
	        $this->end_controls_section(); /* End Dots Style */
		}

		/**
		 * Render HTML
		 */
		protected function render() {
			// Get settings
			$settings = $this->get_settings_for_display();

			// Get template
			$template = tripgo_get_meta_data( 'template', $settings );

			// Show icon
			$show_icon = tripgo_get_meta_data( 'show_icon', $settings );

			// Tab item
			$tab_item = tripgo_get_meta_data( 'tab_item', $settings );

			// Carousel options
			$carousel_options = [
				'items' 				=> tripgo_get_meta_data( 'item_number', $settings ),
				'slideBy' 				=> tripgo_get_meta_data( 'slides_to_scroll', $settings ),
				'margin' 				=> tripgo_get_meta_data( 'margin_items', $settings ),
				'stagePadding' 			=> tripgo_get_meta_data( 'stagePadding', $settings ),
				'autoplayTimeout' 		=> tripgo_get_meta_data( 'autoplay_speed', $settings ),
				'smartSpeed' 			=> tripgo_get_meta_data( 'smartspeed', $settings ),
				'loop' 					=> 'yes' === tripgo_get_meta_data( 'infinite', $settings ) ? true : false,
				'autoplay' 				=> 'yes' === tripgo_get_meta_data( 'autoplay', $settings ) ? true : false,
				'dots' 					=> 'yes' === tripgo_get_meta_data( 'dot_control', $settings ) ? true : false,
				'autoplayHoverPause' 	=> 'yes' === tripgo_get_meta_data( 'pause_on_hover', $settings ) ? true : false,
				'rtl' 					=> is_rtl() ? true: false,
			];

			?>
		 	<div class="ova-gallery-slide <?php echo esc_attr( $template ); ?>">
				<div class="gallery-slide-carousel owl-carousel owl-theme" data-options="<?php echo esc_attr( json_encode( $carousel_options ) ); ?>">
					<?php if ( tripgo_array_exists( $tab_item ) ):
						foreach ( $tab_item as $item ):
							// Get title
							$title = tripgo_get_meta_data( 'title', $item );

							// Get category
							$category = tripgo_get_meta_data( 'category', $item );

							// Get image URL
							$img_url = isset( $item['image']['url'] ) ? $item['image']['url'] : '';

							// Get image alt
							$img_alt = isset( $item['image']['alt'] ) ? $item['image']['alt'] : $title;

							// Get link URL
							$link_url = isset( $item['link']['url'] ) ? $item['link']['url'] : '';

							// Rel
							$nofollow = isset( $item['link']['nofollow'] ) && $item['link']['nofollow'] ? 'nofollow' : '';

							// Target
							$target = isset( $item['link']['is_external'] ) && $item['link']['is_external'] ? '_blank' : '_self';
						?>

						<div class="gallery-slide-img">
							<div class="gallery-img">
								<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
							</div>
							<div class="overlay" data-fancybox="accommodation-gallery-slide" data-src="<?php echo esc_url( $img_url ); ?>"
							data-caption="<?php echo esc_attr( $title ); ?>"></div>
                            <div class="info-wrapper">
                            	<?php if ( 'yes' === $show_icon ):
                            		if ( $link_url ) : ?>	
										<a href="<?php echo esc_url( $link_url ); ?>" aria-label="<?php esc_attr_e( 'View Detail', 'tripgo' ); ?>" rel="<?php echo esc_attr( $nofollow ); ?>" target="<?php echo esc_attr( $target ); ?>">
								    <?php endif; ?>
										<div class="view-detail">
											<i aria-hidden="true" class="icomoon icomoon-arrow-right"></i>
										</div>
									<?php if ( $link_url ): ?>
								    	</a>
							        <?php endif;
							    endif; ?>
                            	<div class="info">
                            		<?php if ( 'template1' === $template && $category ): ?>
										<span class="category">
											<?php echo esc_html( $category ); ?>
										</span>
									<?php endif;

									// Title
									if ( $title ):
										if ( $link_url ): ?>	
											<a href="<?php echo esc_url( $link_url ); ?>" rel="<?php echo esc_attr( $nofollow ); ?>" target="<?php echo esc_attr( $target ); ?>">
									    <?php endif; ?>
											<h3 class="title">
												<?php echo esc_html( $title ); ?>
											</h3>
										<?php if ( $link_url ): ?>
									    	</a>
								        <?php endif;
								    endif;

								    // Template 2
								    if ( 'template2' === $template && $category ): ?>
										<span class="category">
											<?php echo esc_html($category); ?>
										</span>
									<?php endif; ?>
								</div>
                            </div>
						</div>
					<?php endforeach;
					endif; ?>
				</div>
			</div>
			<?php
		}
	}

	// init widget
	$widgets_manager->register( new Tripgo_Elementor_Gallery_Slide() );
}