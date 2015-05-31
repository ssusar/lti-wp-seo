<?php namespace Lti\Wordpress;

if( class_exists('Lti\Wordpress\LTI_Menu')) return;

class LTI_Menu {
	public static $image_base64_url = 'data:image/svg+xml;base64, PHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJMb2dvIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgdmlld0JveD0iMCAwIDQwMCA0MDAiIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDQwMCA0MDAiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPHBhdGggaWQ9IlBhcnJvdCIgZmlsbD0iI0YxRjFGMSIgZD0iTTI1Ni44LDE0Ny43Yy0zLjQtNC45LTEwLTYuMS0xNS0yLjdjLTQuOSwzLjQtNiwxMC0yLjcsMTVjMy40LDQuOSwxMCw2LDE1LDIuNw0KCUMyNTksMTU5LjIsMjYwLjIsMTUyLjYsMjU2LjgsMTQ3Ljd6IE0yNTYuOCwxNDcuN2MtMy40LTQuOS0xMC02LjEtMTUtMi43Yy00LjksMy40LTYsMTAtMi43LDE1YzMuNCw0LjksMTAsNiwxNSwyLjcNCglDMjU5LDE1OS4yLDI2MC4yLDE1Mi42LDI1Ni44LDE0Ny43eiBNMjU2LjgsMTQ3LjdjLTMuNC00LjktMTAtNi4xLTE1LTIuN2MtNC45LDMuNC02LDEwLTIuNywxNWMzLjQsNC45LDEwLDYsMTUsMi43DQoJQzI1OSwxNTkuMiwyNjAuMiwxNTIuNiwyNTYuOCwxNDcuN3ogTTI4MiwxOTguMmMtNi42LDE1LjEtMTIuNSwyOC40LTE5LjQsNDRjMjEuOC0wLjQsMzkuMi0zLjYsNTUuMi0xOC43DQoJQzMwNC4xLDIxMy44LDI5My40LDIwNi4yLDI4MiwxOTguMnogTTMxMS41LDEzMC41Yy0zLjksNy44LTI0LjIsNTctMjQuMiw1N3MxMS4zLDQuNywyMS42LDljMjEsOC44LDIzLjQsMzEuMSwxMiw2MS41DQoJQzM5NC44LDIwNi43LDM2OS4zLDE1MS40LDMxMS41LDEzMC41eiBNMzExLjUsMTMwLjVjLTMuOSw3LjgtMjQuMiw1Ny0yNC4yLDU3czExLjMsNC43LDIxLjYsOWMyMSw4LjgsMjMuNCwzMS4xLDEyLDYxLjUNCglDMzk0LjgsMjA2LjcsMzY5LjMsMTUxLjQsMzExLjUsMTMwLjV6IE0yNjIuNywyNDIuMmMyMS44LTAuNCwzOS4yLTMuNiw1NS4yLTE4LjdjLTEzLjgtOS43LTI0LjUtMTcuMy0zNS45LTI1LjMNCglDMjc1LjQsMjEzLjMsMjY5LjUsMjI2LjYsMjYyLjcsMjQyLjJ6IE0yNDEuOSwxNDVjLTQuOSwzLjQtNiwxMC0yLjcsMTVjMy40LDQuOSwxMCw2LDE1LDIuN2M0LjgtMy40LDYtMTAsMi43LTE1DQoJQzI1My40LDE0Mi44LDI0Ni44LDE0MS41LDI0MS45LDE0NXogTTMxMS41LDEzMC41Yy0zLjksNy44LTI0LjIsNTctMjQuMiw1N3MxMS4zLDQuNywyMS42LDljMjEsOC44LDIzLjQsMzEuMSwxMiw2MS41DQoJQzM5NC44LDIwNi43LDM2OS4zLDE1MS40LDMxMS41LDEzMC41eiBNMjYyLjcsMjQyLjJjMjEuOC0wLjQsMzkuMi0zLjYsNTUuMi0xOC43Yy0xMy44LTkuNy0yNC41LTE3LjMtMzUuOS0yNS4zDQoJQzI3NS40LDIxMy4zLDI2OS41LDIyNi42LDI2Mi43LDI0Mi4yeiBNMjQxLjksMTQ1Yy00LjksMy40LTYsMTAtMi43LDE1YzMuNCw0LjksMTAsNiwxNSwyLjdjNC44LTMuNCw2LTEwLDIuNy0xNQ0KCUMyNTMuNCwxNDIuOCwyNDYuOCwxNDEuNSwyNDEuOSwxNDV6IE0yNTYuOCwxNDcuN2MtMy40LTQuOS0xMC02LjEtMTUtMi43Yy00LjksMy40LTYsMTAtMi43LDE1YzMuNCw0LjksMTAsNiwxNSwyLjcNCglDMjU5LDE1OS4yLDI2MC4yLDE1Mi42LDI1Ni44LDE0Ny43eiBNMjgyLDE5OC4yYy02LjYsMTUuMS0xMi41LDI4LjQtMTkuNCw0NGMyMS44LTAuNCwzOS4yLTMuNiw1NS4yLTE4LjcNCglDMzA0LjEsMjEzLjgsMjkzLjQsMjA2LjIsMjgyLDE5OC4yeiBNMzExLjUsMTMwLjVjLTMuOSw3LjgtMjQuMiw1Ny0yNC4yLDU3czExLjMsNC43LDIxLjYsOWMyMSw4LjgsMjMuNCwzMS4xLDEyLDYxLjUNCglDMzk0LjgsMjA2LjcsMzY5LjMsMTUxLjQsMzExLjUsMTMwLjV6IE0zMTEuNSwxMzAuNWMtMy45LDcuOC0yNC4yLDU3LTI0LjIsNTdzMTEuMyw0LjcsMjEuNiw5YzIxLDguOCwyMy40LDMxLjEsMTIsNjEuNQ0KCUMzOTQuOCwyMDYuNywzNjkuMywxNTEuNCwzMTEuNSwxMzAuNXogTTI4MiwxOTguMmMtNi42LDE1LjEtMTIuNSwyOC40LTE5LjQsNDRjMjEuOC0wLjQsMzkuMi0zLjYsNTUuMi0xOC43DQoJQzMwNC4xLDIxMy44LDI5My40LDIwNi4yLDI4MiwxOTguMnogTTI1Ni44LDE0Ny43Yy0zLjQtNC45LTEwLTYuMS0xNS0yLjdjLTQuOSwzLjQtNiwxMC0yLjcsMTVjMy40LDQuOSwxMCw2LDE1LDIuNw0KCUMyNTksMTU5LjIsMjYwLjIsMTUyLjYsMjU2LjgsMTQ3Ljd6IE0yNTYuOCwxNDcuN2MtMy40LTQuOS0xMC02LjEtMTUtMi43Yy00LjksMy40LTYsMTAtMi43LDE1YzMuNCw0LjksMTAsNiwxNSwyLjcNCglDMjU5LDE1OS4yLDI2MC4yLDE1Mi42LDI1Ni44LDE0Ny43eiBNMjU2LjgsMTQ3LjdjLTMuNC00LjktMTAtNi4xLTE1LTIuN2MtNC45LDMuNC02LDEwLTIuNywxNWMzLjQsNC45LDEwLDYsMTUsMi43DQoJQzI1OSwxNTkuMiwyNjAuMiwxNTIuNiwyNTYuOCwxNDcuN3ogTTIwMCwwQzg5LjcsMCwwLDg5LjcsMCwyMDBzODkuNywyMDAsMjAwLDIwMHMyMDAtODkuNywyMDAtMjAwUzMxMC4zLDAsMjAwLDB6IE0yMTAuNywxNDIuOA0KCWwxMi41LTMuMmwxNy42LTQuM2w0LjYtMS4yYzctMC44LDE0LjQsMi4xLDE4LjcsOC4zYzYuNCw5LDQuMiwyMS41LTQuNywyNy42Yy03LjQsNS4yLTE3LDQuNi0yMy43LTAuN2wtNC4xLTQuNWwtMTEuOC0xMi43DQoJTDIxMC43LDE0Mi44eiBNMzAuMSwxOTUuOEMzMi4zLDEwNCwxMDcuNywzMCwyMDAsMzBjOTMuNywwLDE3MCw3Ni4zLDE3MCwxNzBjMCw4Ni02NC4yLDE1Ny4zLTE0Ny4yLDE2OC41DQoJYzEuMi0zNC45LTIuNS03NS4yLDE3LjUtMTA4LjNjMy4yLTUuMyw2LjMtMTAuOCw5LjMtMTYuMWMxOS4zLTM0LjYsMzQuMi02OS44LDUxLjEtMTA3LjNjNS4zLTEyLDQtMTcuMS01LjEtMjIuNw0KCWMxLjktMTYtOC44LTMwLjktMjEuMS0zOS43Yy0yMC42LTE0LjctNDAuMi0xMi43LTY0LjMtMTQuNmMxNC44LDEuNiwyNC43LDYuOCwzNS43LDE3LjJzOS4zLDExLjUsMTEsMjIuMw0KCWMtMy40LTAuNy02LjctMS4yLTEwLjEtMS42Yy0yLjgtMTcuMS0xOS4xLTI4LjEtMzQuNy0zMi4xYy0yNC40LTYuMy00MiwyLjYtNjUuMiw5LjRjMTQuMy0zLjgsMjUuNS0yLjYsMzkuNSwzLjINCgljMTQuNyw2LDEyLjgsNy41LDE5LDE4LjJjMC41LDAuOCwwLjgsMS40LDEuMiwyLjFjLTIuNywwLjQtNS4zLDAuOS04LDEuNGMtOC0xNC45LTI2LjQtMjAuNC00Mi4xLTE5LjYNCgljLTI1LjEsMS4yLTM5LjQsMTQuOS01OS41LDI4LjJjMTIuNi03LjgsMjMuNi05LjksMzguNy04LjVjMTUuOSwxLjUsMTQuNCwzLjUsMjMuNSwxMS44YzAuMywwLjMsMC42LDAuNiwwLjksMC45DQoJYy0yLjYsMS4yLTUuMiwyLjUtNy44LDMuOGMtMTEuOC0xMi0zMS4xLTEyLjItNDYtNi45Yy0yMy44LDguMy0zMy41LDI1LjQtNDksNDRjOS44LTExLjEsMTkuOC0xNi4zLDM0LjUtMTkuMg0KCWMxNS42LTMuMSwxNC44LTAuOCwyNS45LDQuNmMwLjMsMC4yLDAuNywwLjMsMSwwLjVjLTIuOCwyLjQtNS41LDUtOC4xLDcuNmMtMTMuOC04LTMxLjYtNC40LTQ0LjYsMy4xDQoJQzQ2LjYsMTYxLjUsMzkuNSwxNzcuNSwzMC4xLDE5NS44YzAsMC40LDAsMC45LDAsMS4zYzYuNy05LjIsMTQuOC0xNC45LDI2LjQtMTkuNmMxNC44LTYsMTQuNC0zLjYsMjYuMy0wLjRjMS42LDAuNCwyLjksMC44LDQsMS4xDQoJYy0xLjMsMi4zLTIuNiw0LjYtMy44LDdjLTMuNCw2LjgtNi4yLDE0LTguNCwyMS40Yy0xLjUsNC45LTMuMyw5LjctNS4yLDE0LjRjLTguNSwyMC41LTIwLDM4LjItMjEuMyw1NS4yDQoJYy0xMS41LTIyLjktMTgtNDguOC0xOC03Ni4yYzAtMSwwLTEuOSwwLTIuOSIvPg0KPC9zdmc+';

	public static $main_menuitem;

}