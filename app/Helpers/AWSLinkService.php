<?php

namespace App\Helpers;

use AWS;
use App\Build;

class AwsLinkService
{
	public static function getPresignedLink($folder, $file)
	{
		$s3 = AWS::createClient('s3');
		
		$cmd = $s3->getCommand('GetObject', [
			'Bucket' => $folder,
			'Key'    => $file
		]);

		$request = $s3->createPresignedRequest($cmd, '+60 minutes');

		$presignedUrl = (string)$request->getUri();
		
        return $presignedUrl;
	}
}
