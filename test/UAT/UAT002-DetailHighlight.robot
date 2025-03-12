*** Settings ***
Resource    resource.robot

*** Test Cases ***    
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