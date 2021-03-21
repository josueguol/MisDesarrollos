using System;
/* (c)2003 M.Kruppa */
namespace NetTools
{
	/// <summary>
	/// Summary description for WakeUp class
	/// This is the comand line application class for Wake-Up-On-Lan using MagicPacket Class.
	/// </summary>
	class WakeUp
	{
		/// <summary>
		/// The main entry point for the application.
		/// </summary>
		[STAThread]
		static void Main(string[] args)
		{
			string macAdress; 
			int byteSend;
			Console.WriteLine("WakeUp\n"
				+"Copyright(C)2003 by M. Kruppa <code@mkruppa.com>\n");
				
			//reading comand line arguments
			if ((args.Length != 0) && ((args[0].Length == 12) || (args[0].Length == 17)))
			{
				macAdress = args[0];
				//create MagicPacket(TM)
				MagicPacket wakeUpPacket = new NetTools.MagicPacket(macAdress);
				//wake up machine
				byteSend = wakeUpPacket.WakeUp();
				Console.WriteLine("{0} Byte Send to {1}", byteSend, wakeUpPacket.macAddress);
			}
			else 
			{
				Console.WriteLine("Usage: WakeUp <MAC>\n"
					+"Example: WakeUp A1:B2:C3:D4:E5:F6");
			}
		}
	}
}
