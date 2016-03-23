<?php

namespace App\Helpers;

use AWS;
use App\Build;

class AwsS3Service
{
	public static function getPresignedLink($folder, $file, $minutes = 60)
	{
		try {
			$s3 = AWS::createClient('s3');

			$cmd = $s3->getCommand('GetObject', [
				'Bucket' => $folder,
				'Key'    => $file
			]);

			$request = $s3->createPresignedRequest($cmd, '+'.$minutes.' minutes');
			$presignedUrl = (string)$request->getUri();
		}
		catch(\Exception $e) {
			abort(500);
		}
		
        return $presignedUrl;
	}
	
	public static function uploadObject($folder, $file, $body)
	{		
		try {
			$s3 = AWS::createClient('s3');

			$result = $s3->putObject([
				'Bucket' => $folder,
				'Key'    => $file,
				'Body' => $body
			]);
		}
		catch(\Exception $e) {
			abort(500);
		}
				
        return $result;
	}
}
