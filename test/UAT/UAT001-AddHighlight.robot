*** Settings ***
Resource    resource.robot

*** Test Cases ***
Add New Highlight
    Open Login Page And Login
    Sleep    3s
    Click Manage Highlight Menu
    Click Add Highlight Button
    Sleep    3s
    Fill Highlight Form
    Add Tags
    Submit Highlight Form
    Sleep    2s
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
    Sleep    2s
    Verify Highlight Added
    Close Browser Session

Add New Highlight Not Tag
    Open Login Page And Login
    Sleep    3s
    Click Manage Highlight Menu
    Click Add Highlight Button
    Sleep    3s
    Fill Highlight Form
    Submit Highlight Form
    Sleep    2s
    Verify Highlight Added
    Close Browser Session
    
Edit Highlight
    Open Login Page And Login
    Sleep    3s
    Click Manage Highlight Menu
    Sleep    3s
    Click Edit Highlight Button
    Sleep    1s
    Fill Edit Highlight Form
    Remove One Tag In Edit Form
    Click Update Button
    Sleep    2s
    Close Browser Session
    
Delete Highlight
    Open Login Page And Login
    Sleep    3s
    Click Manage Highlight Menu
    Sleep    3s
    Delete Highlight
    Sleep    2s
    Close Browser Session

Delete Tag Of Highlight
    Open Login Page And Login
    Sleep    3s
    Click Manage Highlight Menu
    Click Add Highlight Button
    Sleep    3s
    Delete Tag
    Sleep    2s
    Close Browser Session