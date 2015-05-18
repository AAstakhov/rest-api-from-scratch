# TryCatch

## Rest API 

### CRUD operations with address records

```
/example.php/address [GET, POST, PUT, DELETE]
```

#### Method GET

Fetches an address record with a given id.

##### GET parameters

Parameter | Type    | Description
--------- | ------- | -----------
id        | integer | Address ID 
 
##### Responses

404 | Address record with the a id is not found


#### Method POST

Adds a new address record.

##### POST parameters

Array with address data.
 
 
##### Responses

400 | Wrong parameters: element count is less then header element count



#### Method PUT

Updates an address record with a given id.

##### GET parameters

Parameter | Type    | Description
--------- | ------- | -----------
id        | integer | Address ID 

##### POST parameters

Array with address data.




#### Method DELETE

Deletes an address record with a given id.

##### GET parameters

Parameter | Type    | Description
--------- | ------- | -----------
id        | integer | Address ID 
 
##### Responses

404 | Address record with the a id is not found




