<?php
    // http://web51.login.cybob-three.com/armin/testArea/screensaver/improved.php?image=matrixBild.jpg&background=FF0000&font=AA1000&canvas=FFFFFF&text=leicht&description=testerloremipsum
    #header("Content-Type: image/jpeg");

    // initialising default variables, if url is not correct
    $image_url = "matrixBild.jpg"; //url also allowed
    $arr_backgroundColor = hex2rgb("D1C200");
    $arr_fontColor = hex2rgb("000066");
    $arr_canvasColor = hex2rgb("6EF761");
    $str_text = "schwer_debug";
    $str_descriptionText = "Lorem ipsum dolor sit amet,\nconsetetur sadipscing elitr, sed diam\nnonumy eirmod tempor invidunt ut labore\net dolore magna....";

    // dynamization of elements: image, background-color, font-color, color of canvas, text, describing text by get Parameters
    // check if value is set/given (in the url) and in image case if the file exists
    if ( $_REQUEST['image'] && file_exists($_REQUEST['image']) ) $image_url = $_REQUEST['image'];                         //CHECK 
    if ( $_REQUEST['background'] ) $arr_backgroundColor = hex2rgb($_REQUEST['background']); //color hex == Function returns array //CHECK
    if ( $_REQUEST['font'] ) $arr_fontColor = hex2rgb($_REQUEST['font']); //color hex == Function returns array       //CHECK
    if ( $_REQUEST['canvas'] ) $arr_canvasColor = hex2rgb($_REQUEST['canvas']); //color hex == Function returns array //CHECK
    if ( $_REQUEST['text'] ) $str_text = $_REQUEST['text']; //string                                                  //CHECK
    if ( $_REQUEST['description'] ) $str_descriptionText = $_REQUEST['description']; //string                         //CHECK

    // Create the size of image or blank image
    #$image = imagecreate(1920, 1080);
    
    $image = imagecreatetruecolor(1920, 1080);
    
    // Set the background color of image
    $background_color = imagecolorallocate($image, $arr_backgroundColor[0], $arr_backgroundColor[1], $arr_backgroundColor[2] );
    imagefilledrectangle($image, 0, 0, 1920, 1080, $background_color);
    
    

    // Set the text color of image
    $text_color = imagecolorallocate($image, $arr_fontColor[0], $arr_fontColor[1], $arr_fontColor[2] );

    // set font-style and create text 
    $font_file = "Source_Sans_Pro/SourceSansPro-Regular.ttf";
    imagettftext ($image, 25, 0, 1300, 250, $text_color, $font_file, $str_text );
    imagettftext ($image, 25, 0, 1300, 400, $text_color, $font_file, $str_descriptionText);
    
    
    // create filled rectangle
    $canvasColor = imagecolorallocate($image, $arr_canvasColor[0], $arr_canvasColor[1], $arr_canvasColor[2]);
    $canvas = imagecreatetruecolor(200, 200);
    imagefilledrectangle($image, 1300, 50, 1750, 150, $canvasColor);

    // adding image
    // dst x & y is for the location
    // src x & y is for cropping the image
    // src width & height is for specifying image detail (=Bildausschnitt)
    // checking for suffix because create function differs
    if ( endsWith($image_url, 'jpg') ){
        $img = imagecreatefromjpeg($image_url);
    }else if ( endsWith($image_url, 'png') ){
        $img = imagecreatefrompng($image_url);
    }
    imagecopymerge($image, $img, 20,30,0, 0, 1024, 1024, 100 );

    // insert logo same way as the image (300x114)
    $logo = imagecreatefrompng("logo.png");
    imagecopymerge($image, $logo, 1550,900,0, 0, 300, 114, 100 );

    #imagejpeg($image,NULL, 100);
    #imagedestroy($image);

    ob_start();
    imagejpeg($image, NULL, 100);
    $imagedata = ob_get_contents();
    ob_end_clean();
    #echo '<img src="data:image/jpeg;base64,'.base64_encode($imagedata).'"/>';
    
    
    
    // returns rgb color code in array 
    function hex2rgb ( $hex_color ): array
    {
        $values = str_replace( '#', '', $hex_color );
        switch ( strlen( $values ) ) {
            case 3;
                list( $r, $g, $b ) = sscanf( $values, "%1s%1s%1s" );
                return array( hexdec( "$r$r" ), hexdec( "$g$g" ), hexdec( "$b$b" ) );
            case 6;
                return array_map( 'hexdec', sscanf( $values, "%2s%2s%2s" ) );
            default:
                return false; // hex2rgb($arr_xColor)
        }
    }

    function endsWith( $haystack, $needle )
    {
        $length = strlen( $needle );
        if( !$length ) {
            return true;
        }
        return substr( $haystack, -$length ) === $needle;
    }