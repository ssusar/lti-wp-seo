<?php namespace Lti\Seo\Generators;

class Link_Rel extends GenericMetaTag {

	public function display_tags() {
		if ( ! is_null( $this->tags ) && ! empty( $this->tags ) ) {
			foreach ( $this->tags as $tag => $value ) {
				echo $this->generate_tag( 'rel', $tag, $value );
			}
		}
	}

	public function generate_tag( $name, $property, $href ) {
		return sprintf( '<link %s="%s" href="%s" />' . PHP_EOL, $name, $property, $href );
	}
}

class Frontpage_Link_Rel extends Link_Rel implements ICanMakeHeaderTags {

	public function make_tags() {

		$tags = array();
		$canonical = $this->settings->get( 'link_rel_canonical' );
		if ( ! is_null( $canonical ) ) {
			$tags['canonical'] = $this->helper->get_canonical_url();
		}

		$tags = apply_filters( 'lti_seo_link_rel', $tags );

		return $tags;
	}

}

class Singular_Link_Rel extends Link_Rel {

	public function make_tags() {

		$tags = array();

		

		$tags = apply_filters( 'lti_seo_link_rel', $tags );

		return $tags;
	}

}