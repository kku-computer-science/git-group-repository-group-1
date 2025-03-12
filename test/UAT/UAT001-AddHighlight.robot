*** Settings ***
Resource    resource.robot

*** Test Cases ***
Add New Highlight
    Open Login Page And Login
    Sleep    1s
    Click Manage Highlight Menu
    Click Add Highlight Button
    Sleep    2s
    Fill Highlight Form
    Add Tags
    Submit Highlight Form
    Sleep    2s
    Verify Highlight Added
    Close Browser Session
    
Add New Highlight Close Exist Tag
    Open Login Page And Login
    Sleep    1s
    Click Manage Highlight Menu
    Click Add Highlight Button
    Sleep    2s
    Fill Highlight Form
    Add Exist Tags
    Submit Highlight Form
    Sleep    2s
    Verify Highlight Added
    Close Browser Session

Add New Highlight Not Tag
    Open Login Page And Login
    Sleep    1s
    Click Manage Highlight Menu
    Click Add Highlight Button
    Sleep    2s
    Fill Highlight Form
    Submit Highlight Form
    Sleep    2s
    Verify Highlight Added
    Close Browser Session
    
Edit Highlight
    Open Login Page And Login
    Sleep    1s
    Click Manage Highlight Menu
    Sleep    2s
    Click Edit Highlight Button
    Sleep    1s
    Fill Edit Highlight Form
    Remove One Tag In Edit Form
    Click Update Button
    Sleep    2s
    Close Browser Session
    
Delete Three Highlights
    Open Login Page And Login
    Sleep    1s
    Click Manage Highlight Menu
    Sleep    2s
    Click Delete Multiple Highlights    3
    Sleep    2s
    Close Browser Session
    
Add Tag In Manage Tag
    Open Login Page And Login
    Sleep    1s
    Click Manage Highlight Menu
    Click Add Highlight Button
    Sleep    2s
    Click Add Tag Button
    Click Manage Tags Button
    Add New Tag
    Verify Tag Added
    Close Browser Session
    
Edit Tag In Manage Tag
    Open Login Page And Login
    Sleep    1s
    Click Manage Highlight Menu
    Sleep    2s
    Click Add Highlight Button
    Sleep    2s
    Click Add Tag Button
    Click Manage Tags Button
    Sleep    2s
    Click Edit Tag Button
    Sleep    2s
    Close Browser Session
    
Delete Tag Of Highlight
    Open Login Page And Login
    Sleep    1s
    Click Manage Highlight Menu
    Click Add Highlight Button
    Sleep    2s
    Delete Tag
    Sleep    2s
    Close Browser Session