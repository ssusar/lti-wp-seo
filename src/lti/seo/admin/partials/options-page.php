<?php
/**
 * LTI SEO plugin
 *
 * Admin View
 *
 */
?>
<!--<div id="lseo-header">-->
<!--<div id="lseo-header-img"></div>-->

<div>

	<?php echo $this->plugin_dir_url ?>
	<br/>
	<?php print_r( ltiopt( 'version' ) ); ?>
	<br/>
	<?php print_r( $this->get_supported_post_types() ); ?>
	<br/><br/>

	<div class="lti-seo-title">
		<h2><?php echo ltint( 'LTI SEO Settings' ); ?></h2>
	</div>
	<div role="tabpanel">

		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active">
				<a href="#tab_general" aria-controls="tab_general" role="tab" data-toggle="tab">General</a>
			</li>
			<li role="presentation">
				<a href="#tab_frontpage" aria-controls="tab_frontpage" role="tab" data-toggle="tab">Front page</a>
			</li>
			<li role="presentation">
				<a href="#tab_social" aria-controls="tab_social" role="tab" data-toggle="tab">Social</a>
			</li>
		</ul>

		<form id="flseo" accept-charset="utf-8" method="POST"
		      action="<?php echo admin_url( 'options-general.php?page=lti-seo-options' ); ?>">
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="tab_general">
					<div class="form-group">
						<div class="input-group">
							<div class="checkbox">
								<label for="canonical_urls">Canonical URLs
									<input type="checkbox" name="canonical_urls"
									       id="canonical_urls" <?php echo ltichk( 'canonical_urls' ); ?>/>
								</label>
							</div>
						</div>
						<div class="form-help-container">
							<div class="form-help">
								<p>Lets Wordpress generate a canonical URL for single pages, and will try to generate
									one for other types of pages.</p>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<label for="global_keywords">Site-wide keywords</label>
							<textarea name="global_keywords"
							          id="global_keywords"><?php echo ltiopt( 'global_keywords' ); ?></textarea>
						</div>
						<div class="form-help-container">
							<div class="form-help">
								<p>A list of comma delimited words (i.e "cats, dogs, elephants") that will be added
									before the keywords for all selected post types.</p>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<label>Generate keywords
								<input type="checkbox" name="generate_keywords"
								       id="generate_keywords" <?php echo ltichk( 'generate_keywords' ); ?>/>
							</label>

							<div class="checkbox-group">
								<label for="keyword_cat">Based on categories
									<input type="checkbox" name="keyword_cat" id="keyword_cat"/>
								</label>
								<label for="keyword_tag">Based on tags
									<input type="checkbox" name="keyword_tag" id="keyword_tag"/>
								</label>
							</div>
						</div>
						<div class="form-help-container">
							<div class="form-help">
								<p>Generate a list of keywords automatically.</p>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="checkbox">
								<label for="meta_description">Description meta tag support
									<input type="checkbox" name="meta_description" id="meta_description"/>
								</label>
							</div>
						</div>
						<div class="form-help-container">
							<div class="form-help">
								<p>Enables a field in the LTI SEO meta box allowing you to input a custom description
									for posts/pages that will be used in a description meta tag.</p>
							</div>
						</div>
					</div>
					<?php echo wp_nonce_field( 'lti_seo_options', 'lti_seo_token' ); ?>
				</div>
				<div role="tabpanel" class="tab-pane" id="tab_frontpage">
					<div class="form-group">
						<div class="input-group">
							<label for="frontpage_description">Description
								<input type="checkbox" name="frontpage_description"
								       id="frontpage_description" <?php echo ltichk( 'frontpage_description' ); ?>/>
							</label>
							<textarea name="frontpage_description_text"
							          id="frontpage_description_text"><?php echo ltiopt( 'frontpage_description_text' ); ?></textarea>
						</div>
						<div class="form-help-container">
							<div class="form-help">
								<p>Adds your own description meta tag that will be applied to the front page.</p>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>JSON-LD</label>

						<div class="form-group">
							<div class="input-group">
								<label for="jsonld_org_info">Person/Organization
									<input type="checkbox" name="jsonld_org_info"
									       id="jsonld_org_info" <?php echo ltichk( 'jsonld_org_info' ); ?>/>
								</label>

								<div class="input-group">
									<label><input name="jsonld_entity_type"
									              type="radio" <?php echo ltirad( 'jsonld_entity_type', 'person' ); ?>
									              value="person"/>Person</label>
									<label><input name="jsonld_entity_type"
									              type="radio" <?php echo ltirad( 'jsonld_entity_type',
											'organization' ); ?> value="organization"/>Organization</label>
								</div>
								<div class="input-group">
									<label for="jsonld_type_name">Name
										<input type="text" name="jsonld_type_name" id="jsonld_type_name"
										       value="<?php echo ltiopt( 'jsonld_type_name' ); ?>"/>
									</label>
								</div>
								<div class="input-group file-selector">
									<label for="jsonld_img">Logo</label>
									<input id="upload_image" type="text" size="36" name="jsonld_type_logo_url"
									       value="<?php echo ltiopt( 'jsonld_type_logo_url' ); ?>"/>
									<input class="button-primary" id="upload_image_button" type="button"
									       value="<?php echo ltint( 'Choose image' ); ?>"/>
								</div>
							</div>
							<div class="form-help-container">
								<div class="form-help">
									<p>JSON LD website search capabilities. The logo only applies to organizations.</p>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<label>Social Accounts</label>

								<div class="input-group">
									<label for="account_facebook">Facebook
										<input type="text" name="account_facebook" id="account_facebook"
										       value="<?php echo ltiopt( 'account_facebook' ); ?>"/>
									</label>
									<label for="account_twitter">Twitter
										<input type="text" name="account_twitter" id="account_twitter"
										       value="<?php echo ltiopt( 'account_twitter' ); ?>"/>
									</label>
									<label for="account_gplus">Google+
										<input type="text" name="account_gplus" id="account_gplus"
										       value="<?php echo ltiopt( 'account_gplus' ); ?>"/>
									</label>
									<label for="account_instagram">Instagram
										<input type="text" name="account_instagram" id="account_instagram"
										       value="<?php echo ltiopt( 'account_instagram' ); ?>"/>
									</label>
									<label for="account_youtube">YouTube
										<input type="text" name="account_youtube" id="account_youtube"
										       value="<?php echo ltiopt( 'account_youtube' ); ?>"/>
									</label>
									<label for="account_linkedin">LinkedIn
										<input type="text" name="account_linkedin" id="account_linkedin"
										       value="<?php echo ltiopt( 'account_linkedin' ); ?>"/>
									</label>
									<label for="account_myspace">Myspace
										<input type="text" name="account_myspace" id="account_myspace"
										       value="<?php echo ltiopt( 'account_myspace' ); ?>"/>
									</label>
								</div>

							</div>
							<div class="form-help-container">
								<div class="form-help">
									<p>A list of comma delimited words (i.e "cats, dogs, elephants") that will be added
										before the keywords for all selected post types.</p>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<label for="jsonld_website_info">Website Information (JSON-LD)
									<input type="checkbox" name="jsonld_website_info"
									       id="jsonld_website_info" <?php echo ltichk( 'jsonld_website_info' ); ?>/>
								</label>
							</div>
							<div class="form-help-container">
								<div class="form-help">
									<p>JSON LD website search capabilities.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="tab_social">
					<div class="form-group">
						<div class="input-group">
							<div class="checkbox">
								<label for="meta_description">Open Graph support
									<input type="checkbox" name="open_graph" id="open_graph"/>
								</label>
							</div>
						</div>
						<div class="form-help-container">
							<div class="form-help">
								<p>Adds the following open graph tags:</p>
								<ul>
									<li>Type, set to 'Article'</li>
									<li>Site name, set to the name of the website</li>
									<li>Url, set to the canonical url for the post type</li>
									<li>Description, set to the value of the description field for the post type</li>
									<li>Locale, set to the site language</li>
									<li>Updated time, set to the last time the post type was updated</li>
									<li>Image, an upload form will appear in the LTI SEO meta box for you to specify an
										image from the media library.
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group-submit">
				<div class="button-group-submit">
					<input id="in-seopt-submit" class="button-primary" type="submit"
					       value="<?php echo ltint( 'Save Changes', 'add-meta-tags' ); ?>"/>
					<input id="in-seopt-reset" class="button-primary" type="submit"
					       value="<?php echo ltint( 'Reset to defaults', 'add-meta-tags' ); ?>"/>
				</div>
			</div>
		</form>
	</div>
</div>