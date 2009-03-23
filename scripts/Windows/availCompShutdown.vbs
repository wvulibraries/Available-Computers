' Suppress Errors
on error resume next

' Create an object that contains network info
Set objNetwork = WScript.CreateObject("WScript.Network")

' Open IE and navigate to address, uses computer name in URI
Set objExplorer = CreateObject("InternetExplorer.Application")
objExplorer.Navigate "http://systemsdev.lib.wvu.edu/availableComputers/updateStats.php?type=shutdown&name=" & objNetwork.ComputerName

' Make IE hidden
objExplorer.Visible = 0

' Pause execution to allow page to load
Wscript.Sleep 1000

' Close IE
objExplorer.Quit
