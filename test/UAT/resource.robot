*** Settings ***
Library    SeleniumLibrary
Library    Collections

*** Variables ***
${BROWSER}          Chrome
${URL_LOGIN}        http://127.0.0.1:8000/login
${USERNAME}         staff@gmail.com
${PASSWORD}         123456789
${TITLE_EN}         Test Title EN
${TITLE_TH}         ทดสอบชื่อเรื่อง TH
${DESCRIPTION_EN}   This is a test description in English.
${DESCRIPTION_TH}   นี่คือคำอธิบายทดสอบในภาษาไทย
${IMAGE_EN}         ${CURDIR}/test_image_en.jpg
${IMAGE_TH}         ${CURDIR}/test_image_th.jpg
${PRIORITY}         1
${NEW_TAG}          New_Tag_Test_1
${NEW_TAG2}         New_Tag_Test_2

*** Keywords ***
Open Login Page And Login
    Open Browser    ${URL_LOGIN}    ${BROWSER}
    Maximize Browser Window
    Sleep    3s
    Input Text    id=username    ${USERNAME}
    Input Text    id=password    ${PASSWORD}
    Click Login Button
    Wait Until Page Contains    Dashboard    5s

Click Login Button
    Click Button    xpath=//button[contains(text(), 'LOGIN')]

Click Manage Highlight Menu
    Click Element    xpath=//a[contains(@class, 'nav-link') and .//span[contains(text(), 'Manage Highlights')]]

Click Add Highlight Button
    Click Element    xpath=//a[contains(@class, 'btn-primary') and .//i[contains(@class, 'mdi-plus')]]

Fill Highlight Form
    Input Text    name=title_en    ${TITLE_EN}
    Input Text    name=title_th    ${TITLE_TH}
    Input Text    name=description_en    ${DESCRIPTION_EN}
    Input Text    name=description_th    ${DESCRIPTION_TH}
    Choose File    name=image_en    ${IMAGE_EN}
    Choose File    name=image_th    ${IMAGE_TH}
    Input Text    name=priority    ${PRIORITY}
    
Add Tags
    Click Button    xpath=//button[contains(text(),'Add Tag')]
    Wait Until Element Is Visible    xpath=//h5[contains(text(),'Select Tags')]    5s
    Wait Until Element Is Visible    xpath=//button[contains(text(),'kku')]    5s
    Click Element    xpath=//button[contains(text(),'kku')]
    Click Element    xpath=//button[contains(text(),'researcher')]
    Click Element    xpath=//button[contains(text(),'CS')]
    Wait Until Element Is Visible    id=newTagName    5s
    Input Text    id=newTagName    ${NEW_TAG}
    Click Button    xpath=//button[@id='addNewTag']
    Sleep    3s
    Click Button    xpath=//button[contains(text(),'Close')]

Add Exist Tags
    Click Button    xpath=//button[contains(text(),'Add Tag')]
    Wait Until Element Is Visible    xpath=//h5[contains(text(),'Select Tags')]    5s
    Wait Until Element Is Visible    id=newTagName    5s
    Input Text    id=newTagName    ${NEW_TAG}
    Click Button    xpath=//button[@id='addNewTag']
    Sleep    3s
    ${ALERT_RESULT} =    Run Keyword And Ignore Error    Handle Alert Error
    Run Keyword If    '${ALERT_RESULT}[0]' == 'PASS'    Log    Alert detected and closed.
    Run Keyword If    '${ALERT_RESULT}[0]' == 'PASS'    Set Variable    ${NEW_TAG2}    ${NEW_TAG2}
    Sleep    3s
    Input Text    id=newTagName    ${NEW_TAG2}
    Sleep    3s
    Click Button    xpath=//button[@id='addNewTag']
    Sleep    3s
    Click Button    xpath=//button[contains(text(),'Close')]

Handle Alert Error
    ${ALERT_TEXT} =    Handle Alert
    Log    Alert Closed: ${ALERT_TEXT}

Submit Highlight Form
    Scroll Element Into View    xpath=//button[contains(text(), 'Save')]
    Click Button    xpath=//button[contains(text(), 'Save')]

Verify Highlight Added
    Page Should Contain    ${TITLE_EN}
    Page Should Contain    ${TITLE_TH}

Close Browser Session
    SeleniumLibrary.Close Browser