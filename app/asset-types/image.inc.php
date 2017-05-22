<?php

Class Image extends Asset {

  static $identifiers = array('jpg', 'jpeg', 'gif', 'png');

  function __construct($file_path) {
  	# create and store additional data required for this asset
    $this->set_extended_data($file_path);
    # create and store data required for this asset
    parent::__construct($file_path);
  }

  function set_extended_data($file_path) {
  	# small/large disabled, not used in X3

    # Get image exif
		$ext = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));
    if(extension_loaded('exif') && ($ext === 'jpg' || $ext === 'jpeg')) {
    	$image = new KEHA76_Exif_Reader();
    	$this->data['exif'] = $image->getDetails($file_path);

    	if(isset($this->data['exif'])) {
    		# Replace image.date
	    	if(isset($this->data['exif']['date_taken'])) $this->data['date'] = strtotime($this->data['exif']['date_taken']);

	    	# width/height
	    	if(isset($this->data['exif']['width'])) $this->data['width'] = $this->data['exif']['width'];
	    	if(isset($this->data['exif']['height'])) $this->data['height'] = $this->data['exif']['height'];
    	}
  	}

    # set asset.width & asset.height variables, if not set from EXIF.
    $img_data = getimagesize($file_path, $info);
    if(!isset($this->data['width']) || !isset($this->data['height'])){
	    preg_match_all('/\d+/', $img_data[3], $dimensions);
	    $this->data['width'] = $dimensions[0][0];
	    $this->data['height'] = $dimensions[0][1];
    }

    # set iptc variables
    if(isset($info["APP13"])) {
      $iptc = iptcparse($info["APP13"]);
      # asset.title or headline
      if(isset($iptc["2#005"][0])) {
      	$this->data['title'] = $this->utf8_validate($iptc["2#005"][0]);
      } else if(isset($iptc["2#105"][0])){
      	$this->data['title'] = $this->utf8_validate($iptc["2#105"][0]);
      }
      # asset.description
      if(isset($iptc["2#120"][0]))
        $this->data['description'] = $this->utf8_validate($iptc["2#120"][0]);
      # asset.keywords
      if(isset($iptc["2#025"][0]))
        $this->data['keywords'] = $this->utf8_validate($iptc["2#025"][0]);
    }

  }

}

?>