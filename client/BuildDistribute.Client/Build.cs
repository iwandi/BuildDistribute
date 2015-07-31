using System;
using System.Collections.Generic;
using System.Text;

namespace BuildDistribute.Client
{
	[Serializable]
	public class Build
	{
		public uint id { get; set; }
		public string project { get; set; }
		//public uint project_id { get; set; }
		public string installUrl { get; set; }
		public string version { get; set; }
		public string platform { get; set; }
		public string revision { get; set; }
		public string androidBundleVersionCode { get; set; }
		public string iPhoneBundleIdentifier { get; set; }
		public string iPhoneBundleVersion { get; set; }
		public string iPhoneTitle { get; set; }
	}
}
