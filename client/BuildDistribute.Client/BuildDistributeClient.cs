using System;
using System.Collections.Generic;
using System.Text;

using RestSharp;

namespace BuildDistribute.Client
{
	public class BuildDistributeClient
	{
		static RestClient client;

		public static void Init(string token)
		{
			client = new RestClient("http://localhost:8000/api/v1/");
			OAuth2Authenticator oauth = new OAuth2AuthorizationRequestHeaderAuthenticator(token);
			client.Authenticator = oauth;
		}

		public static IList<Build> BuildIndex()
		{
			RestRequest req = new RestRequest("build", Method.GET);

			IRestResponse<List<Build>> resp = client.Execute<List<Build>>(req);

			LogResponse(resp);

			return resp.Data;
		}

		public static Build BuildShow(uint id)
		{
			RestRequest req = new RestRequest("build/{id}", Method.GET);
			req.AddUrlSegment("id", id.ToString());

			IRestResponse<Build> resp = client.Execute<Build>(req);			

			LogResponse(resp);

			return resp.Data;
		}

		public static void BuildStore(Build build)
		{
			RestRequest req = new RestRequest("build", Method.POST);
			req.AddObject(build, new string[] { "project", 
				"installUrl",
				"version",
				"platform",
				"revision",
				"androidBundleVersionCode",
				"iPhoneBundleIdentifier",
				"iPhoneBundleVersion",
				"iPhoneTitle" 
			});

			IRestResponse resp = client.Execute(req);

			LogResponse(resp);
		}

		public static void BuildUpdate(Build build)
		{
			RestRequest req = new RestRequest("build/{id}", Method.PATCH);
			req.AddUrlSegment("id", build.id.ToString());
			req.AddObject(build, new string[] { "project", 
				"installUrl",
				"version",
				"platform",
				"revision",
				"androidBundleVersionCode",
				"iPhoneBundleIdentifier",
				"iPhoneBundleVersion",
				"iPhoneTitle" 
			});

			IRestResponse resp = client.Execute(req);

			LogResponse(resp);
		}

		public static void BuildDestroy(uint id)
		{
			RestRequest req = new RestRequest("build/{id}", Method.DELETE);
			req.AddUrlSegment("id", id.ToString());
			IRestResponse resp = client.Execute(req);

			LogResponse(resp);
		}

		public static void BuildDestroy(Build build)
		{
			BuildDestroy(build.id);
		}

		static void LogResponse(IRestResponse response)
		{
			Console.WriteLine(response.Content);
		}
	}
}
