<?php

namespace App\Helpers;

use AWS;
use App\Build;

class AwsLinkService
{
	public static function getAwsPreSignedLink($installFolder, $installFileName)
	{
		$s3 = AWS::createClient('s3');
		
		$cmd = $s3->getCommand('GetObject', [
			'Bucket' => $installFolder,
			'Key'    => $installFileName
		]);

		$request = $s3->createPresignedRequest($cmd, '+60 minutes');

		$presignedUrl = (string)$request->getUri();
		
        return $presignedUrl;
	}
}
