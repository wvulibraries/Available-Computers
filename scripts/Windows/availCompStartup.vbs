' Suppress Errors
on error resume next

' Create an object that contains network info
Set objNetwork = WScript.CreateObject("WScript.Network")

' Open IE and navigate to address, uses computer name in URI
Set objExplorer = CreateObject("InternetExplorer.Application")
objExplorer.Visible = 0

' Navigate to site
objExplorer.Navigate "http://systemsdev.lib.wvu.edu/availableComputers/updateStats.php?type=startup&name=" & objNetwork.ComputerName

' Pause execution to allow page to load
Wscript.Sleep 2000

' Close IE
objExplorer.Quit
