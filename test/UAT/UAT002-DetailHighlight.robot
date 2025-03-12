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
    Add Banner Tags
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
    
Click Banner To Detail And Tag
    Open Browser To Home Page
    Sleep    2s
    Click First Highlight Banner
    Sleep    2s
    Verify Highlight Detail Page
    Click First Tag
    Sleep    2s
    Wait For Page Load
    Verify Highlight List Page
    Click First Highlight In List From Tag
    wait For Page Load
    Verify Highlight Detail Page
    Close Browser Session

Click Highlight To Detail And Tag
    Open Browser To Home Page
    Sleep    2s
    Click First Highlight In List
    Sleep    2s
    Verify Highlight Detail Page
    Click First Tag
    Sleep    2s
    Wait For Page Load
    Verify Highlight List Page
    Click First Highlight In List From Tag
    wait For Page Load
    Verify Highlight Detail Page
    Close Browser Session
    
Delete Three Highlights
    Open Login Page And Login
    Sleep    1s
    Click Manage Highlight Menu
    Sleep    2s
    Click Delete Multiple Highlights    3
    Sleep    2s
    Close Browser Session