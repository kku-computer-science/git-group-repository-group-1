*** Settings ***
Resource    resource.robot

*** Test Cases ***

Add New Highlight Not Tag
    Open Login Page And Login
    Sleep    3s
    Click Manage Highlight Menu
    Click Add Highlight Button
    Sleep    3s
    Fill Highlight Form
    Submit Highlight Form
    Sleep    3s
    Verify Highlight Added
    Close Browser Session
    
Add New Highlight
    Open Login Page And Login
    Sleep    3s
    Click Manage Highlight Menu
    Click Add Highlight Button
    Sleep    3s
    Fill Highlight Form
    Add Tags
    Submit Highlight Form
    Sleep    3s
    Verify Highlight Added
    Close Browser Session
    
Add New Highlight Close Exist Tag
    Open Login Page And Login
    Sleep    3s
    Click Manage Highlight Menu
    Click Add Highlight Button
    Sleep    3s
    Fill Highlight Form
    Add Exist Tags
    Submit Highlight Form
    Sleep    3s
    Verify Highlight Added
    Close Browser Session

Delete Tag Of Highlight
    Open Login Page And Login
    Sleep    3s
    Click Manage Highlight Menu
    Click Add Highlight Button
    Sleep    3s
    Delete Tag
    Sleep    3s
    Close Browser Session
    