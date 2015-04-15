<?php namespace Lti\Seo\Plugin;

class Defaults {
	public $values = array(
		array( "version", 'Text', '1.0.0' ),
		array( 'canonical_urls', 'Checkbox' ),
		array( 'keyword_support', 'Checkbox' ),
		array( 'keyword_tag_based', 'Checkbox' ),
		array( 'keyword_cat_based', 'Checkbox' ),
		array( 'robots_support', 'Checkbox' ),
		array( 'post_robots_noindex', 'Checkbox', false, true ),
		array( 'post_robots_nofollow', 'Checkbox', false, true ),
		array( 'post_robots_noodp', 'Checkbox', false, true ),
		array( 'post_robots_noydir', 'Checkbox', false, true ),
		array( 'post_robots_noarchive', 'Checkbox', false, true ),
		array( 'post_robots_nosnippet', 'Checkbox', false, true ),
		array( 'robots_noindex', 'Checkbox' ),
		array( 'robots_nofollow', 'Checkbox' ),
		array( 'robots_noodp', 'Checkbox' ),
		array( 'robots_noydir', 'Checkbox' ),
		array( 'robots_noarchive', 'Checkbox' ),
		array( 'robots_nosnippet', 'Checkbox' ),
		array( 'robots_date_based', 'Checkbox' ),
		array( 'robots_cat_based', 'Checkbox' ),
		array( 'robots_tag_based', 'Checkbox' ),
		array( 'robots_author_based', 'Checkbox' ),
		array( 'robots_search_based', 'Checkbox' ),
		array( 'robots_notfound_based', 'Checkbox' ),
		array( 'meta_description', 'Checkbox' ),
		array( 'open_graph_support', 'Checkbox' ),
		array( 'facebook_publisher', 'Url' ),
		array( 'frontpage_description', 'Checkbox' ),
		array( 'frontpage_description_text', 'Text' ),
		array( 'frontpage_keyword', 'Checkbox' ),
		array( 'frontpage_keyword_text', 'Text' ),
		array( 'frontpage_social_img_url', 'Url' ),
		array( 'frontpage_social_img_id', 'Text' ),
		array( 'jsonld_website_info', 'Checkbox' ),
		array( 'jsonld_org_info', 'Checkbox' ),
		array(
			'jsonld_entity_type',
			'Radio',
			array( 'default' => 'person', 'choice' => array( 'person', 'organization' ) )
		),
		array( 'jsonld_type_name', 'Text' ),
		array( 'jsonld_type_logo_url', 'Url' ),
		array( 'jsonld_type_logo_id', 'Text' ),
		array( 'twitter_card_support', 'Checkbox' ),
		array( 'twitter_publisher', 'Text' ),
		array(
			'twitter_card_type',
			'Radio',
			array( 'default' => 'summary', 'choice' => array( 'summary', 'summary_img' ) )
		),
		array( 'gplus_publisher', 'Url' ),
		array( 'account_facebook', 'Url' ),
		array( 'account_twitter', 'Url' ),
		array( 'account_gplus', 'Url' ),
		array( 'account_instagram', 'Url' ),
		array( 'account_youtube', 'Url' ),
		array( 'account_linkedin', 'Url' ),
		array( 'account_myspace', 'Url' ),
	);
}

class Plugin_Settings {
	public function __construct( $settings = array() ) {

		$defaults = new Defaults();

		foreach ( $defaults->values as $value ) {
			$valueIsTracked = ( isset( $value[3] ) ) ? true : false;

			$storedValue = null;
			if ( isset( $settings->{$value[0]} ) && ! is_object( $settings->{$value[0]} ) ) {
				$storedValue = $settings->{$value[0]};
			}
			$className = __NAMESPACE__ . "\\Field_" . $value[1];

			if ( isset( $value[2] ) ) {
				$this->{$value[0]} = new $className( $storedValue, $value[2], $valueIsTracked );
			} else {
				$this->{$value[0]} = new $className( $storedValue, null, $valueIsTracked );
			}
		}
	}

	public static function get_defaults() {
		return new self();
	}

	public function save( Array $values = array() ) {
		return new Plugin_Settings( (object) $values );
	}

	public function get( $value ) {
		if ( isset( $this->{$value} ) && ! empty( $this->{$value}->value ) && ! is_null( $this->{$value}->value ) ) {
			return $this->{$value}->value;
		}

		return null;
	}

	public function set( $key, $value, $type = "Text" ) {
		$className    = __NAMESPACE__ . "\\Field_" . $type;
		$this->{$key} = new $className( $value );
	}

	public function compare( $values ) {
		$changed       = array();
		$currentValues = get_object_vars( $this );
		$oldValues     = get_object_vars( $values );

		foreach ( $currentValues as $key => $value ) {
			if ( $value->isTracked ) {
				if ( isset( $oldValues[ $key ] ) && $oldValues[ $key ]->value != $value->value ) {
					$changed[ $key ] = $value->value;
				}
			}
		}

		return $changed;

	}
}

