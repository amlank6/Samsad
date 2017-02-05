<?php 
function checkFolderIsEmptyOrNot ( )
{
 $files = array ();
 $folderName = "../cache";
    if ( $handle = opendir ( $folderName ) )
	{
        while ( false !== ( $file = readdir ( $handle ) ) )
		{
            if ( $file != "." && $file != ".." )
			{
                $files [] = $file;
            }
        }
        closedir ( $handle );
    }
    return	( count ( $files ) > 0 ) ?  TRUE: FALSE;
	
	/*foreach($files as $file=>$value)
	{
	echo $value;
	}*/
}
?>