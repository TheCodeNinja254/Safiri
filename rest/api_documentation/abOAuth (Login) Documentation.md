**AfricaBeat OAUTH Procedure**
----
  <_AfricaBeat OAUTH callback accepts the users username and password and returns a payload response depending on the result of the execution._>

* **URL**

  <_The URL Structure (path only, no root url)_>
  
  `/rest/abOAuth/`
  
<_Hence the method is `abOAuth`_>
  
  
*  **URL Params**

   <_The method accepts the `username` and the `password` _> 

<_For test use `username= admin` and the `password=trial` _> 

   **Required:**
 
   `username=[varchar]`
   
   `password=[varchar]`




* **Success Response:**
  
  <_In a successful attempt, the response is as follows_>

  * **Code:** 200 <br />
    **Content:** `{
                      "response": true,
                      "data": {
                          "user_id": "1",
                          "username": "admin",
                          "email_address": "admin@africabeat.co.ke",
                          "phone_no": "0725362514",
                          "f_name": "Collins",
                          "m_name": "Mucheru",
                          "l_name": "Njoroge",
                          "access_level": "1",
                          "current_session_key": "ab-1506064765-55392079258374-d9JOFdGsCBzls5Ofi1MK8D12lcflZWIo9zYNjIrwRmaNwZCrW5JcQC5QUE8Lasu8B4vaL"
                      }
                  }`
 
* **Incorrect Credentials - password:**

  * **Code:** 200 <br />
    **Content:** `{
                      "data": {
                          "response": false,
                          "error": "AUTH_FAILED",
                          "current_session_key": null
                      }
                  }`
                  
  * **Incorrect Credentials - Username:**
  
    * **Code:** 200 <br />
      **Content:** `{
                        "data": {
                            "response": false,
                            "error": "AUTH_FAILED",
                            "extended_error": "CSK_UNSET_FAILED",
                            "current_session_key": null
                        }
                    }`                


* **Notes:**

  <_`The csk_unset_failed` referes to missing username case, the `current_session_key` must be in every api call as the second path segment after the `method` _> 