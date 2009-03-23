' Suppress Errors
on error resume next

' Create an object that contains network info
Set objNetwork = WScript.CreateObject("WScript.Network")

' Open IE and navigate to address, uses computer name in URI
Set objExplorer = CreateObject("InternetExplorer.Application")
objExplorer.Navigate "http://systemsdev.lib.wvu.edu/availableComputers/updateStats.php?type=logoff&name=" & objNetwork.ComputerName

' Make IE hidden
objExplorer.Visible = 0


' Create shell object
Set objShell = CreateObject("WScript.Shell")

' Clear browser history
strCommand = "RunDll32.exe InetCpl.cpl,ClearMyTracksByProcess 1"
objShell.Run strCommand


' Close IE
objExplorer.Quit
