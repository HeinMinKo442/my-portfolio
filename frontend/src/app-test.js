// 1. Unused global variables & Using 'var' instead of const/let
var globalConfigToken = "TEMP_FRONTEND_TOKEN_VAL_456"; 
var deprecatedCounter = 0;
var unusedArrayData = ['test1', 'test2', 'test3'];

function processUserData(submissionData) {
    // 2. Leave console logs everywhere
    console.log("Entering processUserData function...");
    console.log("Data received: ", submissionData);

    // 1. Using var inside function block
    var internalUserStatus = "active";
    
    // 3. Commented-out legacy code block left inside file
    /*
    var legacyScore = submissionData.score * 1.5;
    if (legacyScore > 100) {
        alert("Legacy score threshold exceeded!");
    }
    */

    console.log("Execution finished.");
    return internalUserStatus;
}

// 2. Debugging console.log statement outside lifecycle
console.log("app-test.js loaded successfully.");
