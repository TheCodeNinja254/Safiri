**AfricaBeat OAUTH Method Call Procedure**
----
  <_AfricaBeat OAUTH callbacks_>

* **URL**

  <_The URL Structure (path only, no root url)_>
  
  `/rest/method/current_session_key/`
  

*  **URL Params**

   <_The method accepts the `method` and the `current_session_key` _> 


   **Required:**
 
   `method=[text]`
   
   `current_session_key=[varchar] - open_ssl_hash_key`




* **Success Response:**
  
  <_In a successful attempt, the response is as follows_>

  * **Code:** 200 <br />
    **Content:** Will be JSON for the callback/method passed
 
* **Incorrect `current_session_key`:**

  * **Code:** 200 <br />
    **Content:** `{
                      "data": {
                          "response": false,
                          "error": "OAUTH_ERROR",
                          "extended_error": "INVALID_AB_OAUTH_TOKEN"
                      }
                  }`
                  
  * **Missing `current_session_key`:**
  
    * **Code:** 200 <br />
      **Content:** `{
                        "data": {
                            "response": false,
                            "error": "OAUTH_ERROR",
                            "extended_error": "NO_AB_OAUTH_TOKEN"
                        }
                    }`                


* **Notes:**

  <_The `current_session_key` must be in every api call as the second path segment after the `method` _> 