<?php namespace Lti\Seo\Generators;

class Keyword extends GenericMetaTag {

	public function display_tags() {
		if ( !is_null( $this->tags ) && ! empty( $this->tags ) ) {
			echo $this->generate_tag( 'name', 'keywords', $this->tags );
		}
	}
}

class Frontpage_Keyword extends Keyword implements ICanMakeHeaderTags {

	public function make_tags() {

		$tags = $this->helper->get_keywords($this->post_id);

		$tags = apply_filters( 'lti_seo_keywords', $tags );

		if ( !is_null( $tags )&&!empty($tags) ) {
			return $tags;
		}
		return null;
	}

}

class Singular_Keyword extends Frontpage_Keyword {


}