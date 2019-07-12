 <?php


    class imageUploader
    {
      const UPLOADS_FOLDER = 'uploads';
      //added this code
      public static $imagepath;

      static function upload()
      {
        $imagefile = $_FILES;
        
        if( !isset($imagefile['image']['error']) )
          throw new RuntimeException('Invalid parameters.');

        //multiple uploads not permitted. you should queue file uploads from the client
        if(is_array($imagefile['image']['error']))
          throw new RuntimeException('Only one file allowed.');

        switch ($imagefile['image']['error']) {
          case UPLOAD_ERR_OK:
            break;
          case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
          case UPLOAD_ERR_INI_SIZE:
          case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
          default:
            throw new RuntimeException('Unknown errors.');
        }

        $max = ini_get('upload_max_filesize') * 1000 * 1000;
        if ($imagefile['image']['size'] > $max)
            throw new RuntimeException('Exceeded filesize limit.');

        //check the file type - but not the one sent by the browser instead use finfo
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($_FILES['image']['tmp_name']);
        $allowed = array('jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif');
        $ext = array_search($mime, $allowed, true);

        if(false === $ext)
          throw new RuntimeException('Invalid file format.');

        $path = sprintf( self::UPLOADS_FOLDER . '/%s.%s', sha1_file($imagefile['image']['tmp_name']), $ext );
        if (!move_uploaded_file( $imagefile['image']['tmp_name'],$path))
          throw new RuntimeException('Failed to move uploaded file.');
        else
        {
          //added this code
          self::$imagepath=$path;
           return true;
        }
         
      }
    }


    ?>