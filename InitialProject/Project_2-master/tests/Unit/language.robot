*** Settings ***
Resource    resource.robot

*** Test Cases ***
Open Browser For Home Page
    Open Browser To Home Page
    Sleep    2s
    Click Element    id=navbarDropdownMenuLink
    Wait Until Element Is Visible    css:div.dropdown-menu[aria-labelledby="navbarDropdownMenuLink"]    10s
    Click Element    xpath=(//div[contains(@class, "dropdown-menu") and @aria-labelledby="navbarDropdownMenuLink"]//a[contains(@class, "dropdown-item")])[1]
    Sleep    2s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_HOME}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    Close Browser

Open Browser For Researcher_cs Page
    Open Browser To Researcher_cs Page
    Sleep    2s
    Click Element    id=navbarDropdownMenuLink
    Wait Until Element Is Visible    css:div.dropdown-menu[aria-labelledby="navbarDropdownMenuLink"]    10s
    Click Element    xpath=(//div[contains(@class, "dropdown-menu") and @aria-labelledby="navbarDropdownMenuLink"]//a[contains(@class, "dropdown-item")])[1]
    Sleep    2s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_RESEARCHER_CS}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    Close Browser

Open Browser For Researcher_it Page
    Open Browser To Researcher_it Page
    Sleep    2s
    Click Element    id=navbarDropdownMenuLink
    Wait Until Element Is Visible    css:div.dropdown-menu[aria-labelledby="navbarDropdownMenuLink"]    10s
    Click Element    xpath=(//div[contains(@class, "dropdown-menu") and @aria-labelledby="navbarDropdownMenuLink"]//a[contains(@class, "dropdown-item")])[1]
    Sleep    2s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_RESEARCHER_IT}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    Close Browser

Open Browser For Researcher_gis Page
    Open Browser To Researcher_gis Page
    Sleep    2s
    Click Element    id=navbarDropdownMenuLink
    Wait Until Element Is Visible    css:div.dropdown-menu[aria-labelledby="navbarDropdownMenuLink"]    10s
    Click Element    xpath=(//div[contains(@class, "dropdown-menu") and @aria-labelledby="navbarDropdownMenuLink"]//a[contains(@class, "dropdown-item")])[1]
    Sleep    2s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_RESEARCHER_GIS}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    Close Browser

Open Browser For Research Project Page
    Open Browser To Research Project Page
    Sleep    2s
    Click Element    id=navbarDropdownMenuLink
    Wait Until Element Is Visible    css:div.dropdown-menu[aria-labelledby="navbarDropdownMenuLink"]    10s
    Click Element    xpath=(//div[contains(@class, "dropdown-menu") and @aria-labelledby="navbarDropdownMenuLink"]//a[contains(@class, "dropdown-item")])[1]
    Sleep    2s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_RESEARCH_PROJECT}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    Close Browser

Open Browser For Research Group Page
    Open Browser To Research Group Page
    Sleep    2s
    Click Element    id=navbarDropdownMenuLink
    Wait Until Element Is Visible    css:div.dropdown-menu[aria-labelledby="navbarDropdownMenuLink"]    10s
    Click Element    xpath=(//div[contains(@class, "dropdown-menu") and @aria-labelledby="navbarDropdownMenuLink"]//a[contains(@class, "dropdown-item")])[1]
    Sleep    2s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_RESEARCH_GROUP}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    Close Browser

Open Browser For Reports Page
    Open Browser To Reports Page
    Sleep    2s
    Click Element    id=navbarDropdownMenuLink
    Wait Until Element Is Visible    css:div.dropdown-menu[aria-labelledby="navbarDropdownMenuLink"]    10s
    Click Element    xpath=(//div[contains(@class, "dropdown-menu") and @aria-labelledby="navbarDropdownMenuLink"]//a[contains(@class, "dropdown-item")])[1]
    Sleep    2s
    ${html_source}=    Get Source
    Log    HTML Source: ${html_source}
    FOR    ${word}    IN    @{EXPECTED_WORDS_REPORT}
        Log    Checking for word: ${word}
        Should Contain    ${html_source}    ${word}
    END
    Close Browser