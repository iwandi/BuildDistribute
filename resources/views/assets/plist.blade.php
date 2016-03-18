<?php print "<?xml version='1.0' encoding='UTF-8'?>"; ?>
<?php print "<!DOCTYPE plist PUBLIC ' -//Apple//DTD PLIST 1.0//EN' 'http://www.apple.com/DTDs/PropertyList-1.0.dtd'>"; ?>
<?php print "<plist version='1.0'>"; ?>
<dict>
  <key>items</key>
  <array>
    <dict>
      <key>assets</key>
      <array>
        <dict>
          <key>kind</key>
          <string>software-package</string>
          <key>url</key>
          <string>{!!url($data['url'])!!}</string>
        </dict>
      </array>
      <key>metadata</key>
      <dict>
        <key>bundle-identifier</key>
        <string>{{$data['bundleIdentifier']}}</string>
        <key>bundle-version</key>
        <string>{{$data['bundleVersion']}}</string>
        <key>kind</key>
        <string>software</string>
        <key>title</key>
        <string>{{$data['iphoneTitle']}}</string>
      </dict>
    </dict>
  </array>
</dict>
</plist>