using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;

using BuildDistribute.Client;

namespace BuildDistribute.CmdClient
{
	class Program
	{
		static void Main(string[] args)
		{
			BuildDistributeClient.Init();
			if (args.Length == 0)
			{
				bool quit = false;
				while(!quit)
				{
					Console.WriteLine();
					Console.Write(">");
					string cmd = Console.ReadLine();
					quit = cmd == "quit";
					if (!quit)
					{
						string[] iArgs = cmd.Split(' ');
						ExecCommand(iArgs);
					}
				}
			}
			else
			{
				ExecCommand(args);
			}
		}

		static void ExecCommand(string[] args)
		{
			switch (args[0])
			{
				case "index":
					PrintBuildList(BuildDistributeClient.BuildIndex());
					break;
				case "show":
					PrintBuild(BuildDistributeClient.BuildShow(uint.Parse(args[1])));
					break;
				case "store":
					BuildDistributeClient.BuildStore(ParseBuild(args[1]));
					break;
				case "update":
					Build build;
					if (args[1] == "test")
					{
						uint id = uint.Parse(args[2]);
						build = BuildDistributeClient.BuildShow(id);
						build.revision = (int.Parse(build.revision) + 1).ToString();
					}
					else
					{
						build = ParseBuild(args[1]);
					}
					BuildDistributeClient.BuildUpdate(build);
					break;
				case "destroy":
					BuildDistributeClient.BuildDestroy(uint.Parse(args[1]));
					break;
				default:
					Console.WriteLine("Unknown Command");
					break;
			}
		}

		static Build ParseBuild(string arg)
		{
			if (arg == "test")
			{
				Build build = new Build();
				build.project = "Tinker";
				//build.project_id = 1;
				build.installUrl = "http://www.wolpertingergames.com";
				build.version = "1.0";
				build.platform = "Web";
				build.revision = "1000";
				build.androidBundleVersionCode = "";
				build.iPhoneBundleIdentifier = "";
				build.iPhoneBundleVersion = "";
				build.iPhoneTitle = "";

				return build;
			}
			return null;
		}

		static void PrintBuildList(IList<Build> buildList)
		{
			if (buildList == null || buildList.Count <= 0)
			{
				Console.WriteLine("NULL or Empty Build List");
			}
			else
			{
				foreach (Build build in buildList)
				{
					PrintBuild(build);
				}
			}
		}

		static void PrintBuild(Build build)
		{
			if (build == null)
			{
				Console.WriteLine("Build == null");
			}
			else
			{
				Console.WriteLine(build.ToString());
			}
		}
	}
}
