<?php

class SculpinKernel extends \Sculpin\Bundle\SculpinBundle\HttpKernel\AbstractKernel {
  protected function getAdditionalSculpinBundles() {
    return array(
      'Tsphethean\Sculpin\Bundle\RelatedPostsBundle\SculpinRelatedPostsBundle',
    );
  }
}