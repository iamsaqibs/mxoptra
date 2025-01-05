# Maxoptra API Documentation

Generated on: Sat Jan  4 15:23:08 PKT 2025

This documentation describes the Maxoptra API endpoints for managing locations, drivers, orders, and other resources.

## Table of Contents

- [Get a list of customer locations](#get-a-list-of-customer-locations)
- [Create a customer location](#create-a-customer-location)
- [Create a location](#create-a-location)
- [Get customer location details](#get-customer-location-details)
- [Partially update a customer location](#partially-update-a-customer-location)
- [Delete a customer location](#delete-a-customer-location)
- [Delete a location](#delete-a-location)
- [Update a customer location](#update-a-customer-location)
- [Update a location](#update-a-location)
- [Get a list of distribution centres](#get-a-list-of-distribution-centres)
- [Get a list of drivers](#get-a-list-of-drivers)
- [Get a list of drivers](#get-a-list-of-drivers)
- [Create a driver](#create-a-driver)
- [Create a new driver](#create-a-new-driver)
- [Get driver details](#get-driver-details)
- [Get details of a single driver by reference.](#get-details-of-a-single-driver-by-reference.)
- [Partially update a driver](#partially-update-a-driver)
- [Update certain fields of a driver. All fields are optional, only specified fields are updated.](#update-certain-fields-of-a-driver.-all-fields-are-optional,-only-specified-fields-are-updated.)
- [Delete a driver](#delete-a-driver)
- [Delete a driver](#delete-a-driver)
- [Update a driver](#update-a-driver)
- [Update a driver by reference](#update-a-driver-by-reference)
- [Get execution details of an order](#get-execution-details-of-an-order)
- [Get order items for an order](#get-order-items-for-an-order)
- [Get POD details for an order](#get-pod-details-for-an-order)
- [Get POD details, including signature and its metadata.](#get-pod-details,-including-signature-and-its-metadata.)
- [Get tracking info for an order](#get-tracking-info-for-an-order)
- [Get a list of orders](#get-a-list-of-orders)
- [Get all the orders for a specific territory](#get-all-the-orders-for-a-specific-territory)
- [Create an order](#create-an-order)
- [Get order details](#get-order-details)
- [Update an order](#update-an-order)
- [Partially update an order](#partially-update-an-order)
- [Delete an order](#delete-an-order)
- [Get widget info for order by reference](#get-widget-info-for-order-by-reference)
- [Get loading state of an order](#get-loading-state-of-an-order)
- [Get vehicle details](#get-vehicle-details)
- [Update an existing vehicle](#update-an-existing-vehicle)
- [Update a vehicle](#update-a-vehicle)
- [Partially update a vehicle](#partially-update-a-vehicle)
- [Update a vehicle. Only updates specified fields. None of the fields are mandatory.](#update-a-vehicle.-only-updates-specified-fields.-none-of-the-fields-are-mandatory.)
- [Delete a vehicle](#delete-a-vehicle)
- [Delete a vehicle](#delete-a-vehicle)
- [Get a list of vehicles](#get-a-list-of-vehicles)
- [Get a list of vehicles](#get-a-list-of-vehicles)
- [Create a vehicle](#create-a-vehicle)
- [Create a vehicle](#create-a-vehicle)
- [Get schedule for a distribution centre](#get-schedule-for-a-distribution-centre)
- [Get allocated schedule](#get-allocated-schedule)
- [Get schedule for a vehicle](#get-schedule-for-a-vehicle)
- [Get schedule for a driver](#get-schedule-for-a-driver)
- [Create a subscription](#create-a-subscription)
- [Create a Webhook subscription for specified event type.](#create-a-webhook-subscription-for-specified-event-type.)
- [Get a list of subscriptions](#get-a-list-of-subscriptions)
- [Get a subscription](#get-a-subscription)
- [Delete a subscription](#delete-a-subscription)
- [Deletes a subscription by reference if it exists](#deletes-a-subscription-by-reference-if-it-exists)
- [Get subscription communication log](#get-subscription-communication-log)
- [Get all communications logs regarding your subscription](#get-all-communications-logs-regarding-your-subscription)
- [Get loading info for run](#get-loading-info-for-run)

---


<a name="get-a-list-of-customer-locations"></a>
## Get a list of customer locations

### Method
`GET`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/locations`

### Description
Receive a list of customer locations

### Request

### Query Parameters

### Description
How many records to skip. 0 by default

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

#### Body

Content Type: `application/json`

### Description
Spring fountains Inc.

### Description
PagingLinks

### Description
Relative URL of the previous page of results. Use this to navigate back to the previous page.Show all...

### Description
Relative URL of the next page of results. Use this to navigate to the next page.Show all...

```json{
    "data": [
      {
        "referenceNumber": "abc123",
        "name": "Spring fountains Inc.",
        "address": "55 Springs road, BR1 4FG, Brighton",
        "w3wAddress": "///rival.mirror.helps",
        "postcode": "BR1 4FG",
        "latitude": 0,
        "longitude": 0,
        "clientName": "null",
        "isVerified": true,
        "isValid": true,
        "created": "2019-08-24T14:15:22Z",
        "updated": "2019-08-24T14:15:22Z"
      }
    ],
    "offset": 0,
    "_links": {
      "prev": "/orders?offset=20",
      "next": "/orders?offset=40"
    }
}
```


<a name="create-a-customer-location"></a>
## Create a customer location

### Method
`POST`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/locations`

<a name="create-a-location"></a>
## Create a location

### Request

#### Body

Content Type: `application/json`

### Description
Spring fountains Inc.

### Description
TimeWindow

### Description
TimeWindow

### Description
TimeWindow

### Description
TimeWindow

### Description
TimeWindow

### Description
TimeWindow

### Description
TimeWindow

### Description
TimeWindow

### Description
TimeWindow

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

### Description
Location successfully created.

#### Body

Content Type: `application/json`
| `200` | - |

### Description
An integer warning code

### Description
Any additional details that the warning message may carry.

### Description
Location

### Description
Spring fountains Inc.

```json{
    "referenceNumber": "abc123",
    "name": "Spring fountains Inc.",
    "address": "55 Springs road, BR1 4FG, Brighton",
    "w3wAddress": "///rival.mirror.helps",
    "postcode": "BR1 4FG",
    "latitude": 0,
    "longitude": 0,
    "description": "string",
    "clientName": "null",
    "primaryTelephone": "string",
    "secondaryTelephone": "string",
    "email": "string",
    "website": "string",
    "settings": {
      "allowSMS": true,
      "allowEmail": true,
      "fixedTimePerAddress": 0,
      "fixedTimePerOrder": 0,
      "timePerCapacityDelivery": 0,
      "preferredDriverReferences": [
        "string"
      ],
      "vehicleRequirementsReferences": [
        "string"
      ]
    },
    "availability": {
      "monday": {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      },
      "tuesday": {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      },
      "wednesday": {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      },
      "thursday": {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      },
      "friday": {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      },
      "saturday": {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      },
      "sunday": {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      },
      "holiday": {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      },
      "default": {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      }
    },
    "created": "2019-08-24T14:15:22Z",
    "updated": "2019-08-24T14:15:22Z"
}
```


```json{
    "warnings": [
      {
        "code": "string",
        "name": "string",
        "details": "string",
        "field": "string"
      }
    ],
    "data": {
      "referenceNumber": "abc123",
      "name": "Spring fountains Inc.",
      "address": "55 Springs road, BR1 4FG, Brighton",
      "w3wAddress": "///rival.mirror.helps",
      "postcode": "BR1 4FG",
      "latitude": 0,
      "longitude": 0,
      "isVerified": true,
      "isValid": true,
      "description": "string",
      "clientName": "null",
      "primaryTelephone": "string",
      "secondaryTelephone": "string",
      "email": "string",
      "website": "string",
      "settings": {
        "allowSMS": true,
        "allowEmail": true,
        "fixedTimePerAddress": 0,
        "fixedTimePerOrder": 0,
        "timePerCapacityDelivery": 0,
        "preferredDriverReferences": [
          "string"
        ],
        "preferredDriverNames": [
          "string"
        ],
        "vehicleRequirementsReferences": [
          "string"
        ]
      },
      "availability": {
        "monday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "tuesday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "wednesday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "thursday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "friday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "saturday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "sunday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "holiday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "default": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        }
      },
      "created": "2019-08-24T14:15:22Z",
      "updated": "2019-08-24T14:15:22Z"
    }
}
```


<a name="get-customer-location-details"></a>
## Get customer location details

### Method
`GET`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/locations/{reference}`

### Description
Returns details of a particular location by it's reference.

### Request

### Path Parameters

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

#### Body

Content Type: `application/json`
| `200` | - |

### Description
Location

### Description
Spring fountains Inc.

```json{
    "data": {
      "referenceNumber": "abc123",
      "name": "Spring fountains Inc.",
      "address": "55 Springs road, BR1 4FG, Brighton",
      "w3wAddress": "///rival.mirror.helps",
      "postcode": "BR1 4FG",
      "latitude": 0,
      "longitude": 0,
      "isVerified": true,
      "isValid": true,
      "description": "string",
      "clientName": "null",
      "primaryTelephone": "string",
      "secondaryTelephone": "string",
      "email": "string",
      "website": "string",
      "settings": {
        "allowSMS": true,
        "allowEmail": true,
        "fixedTimePerAddress": 0,
        "fixedTimePerOrder": 0,
        "timePerCapacityDelivery": 0,
        "preferredDriverReferences": [
          "string"
        ],
        "preferredDriverNames": [
          "string"
        ],
        "vehicleRequirementsReferences": [
          "string"
        ]
      },
      "availability": {
        "monday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "tuesday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "wednesday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "thursday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "friday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "saturday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "sunday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "holiday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "default": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        }
      },
      "created": "2019-08-24T14:15:22Z",
      "updated": "2019-08-24T14:15:22Z"
    }
}
```


<a name="partially-update-a-customer-location"></a>
## Partially update a customer location

### Method
`PATCH`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/locations/{reference}`

### Request

### Path Parameters

#### Body

Content Type: `application/json`

### Description
Spring fountains Inc.

### Description
TimeWindow

### Description
TimeWindow

### Description
TimeWindow

### Description
TimeWindow

### Description
TimeWindow

### Description
TimeWindow

### Description
TimeWindow

### Description
TimeWindow

### Description
TimeWindow

### Responses

| Code | Description |
|------|-------------|
| `200` | - |
| `404` | The location has been succesfully updated |

#### Body

Content Type: `application/json`
| `200` | - |

### Description
Location

### Description
Spring fountains Inc.

### Description
An integer warning code

### Description
Any additional details that the warning message may carry.

```json{
    "referenceNumber": "abc123",
    "name": "Spring fountains Inc.",
    "address": "55 Springs road, BR1 4FG, Brighton",
    "postcode": "BR1 4FG",
    "latitude": 0,
    "longitude": 0,
    "description": "string",
    "clientName": "null",
    "primaryTelephone": "string",
    "secondaryTelephone": "string",
    "email": "string",
    "website": "string",
    "settings": {
      "allowSMS": true,
      "allowEmail": true,
      "fixedTimePerAddress": 0,
      "fixedTimePerOrder": 0,
      "timePerCapacityDelivery": 0,
      "preferredDriverReferences": [
        "string"
      ],
      "vehicleRequirementsReferences": [
        "string"
      ]
    },
    "availability": {
      "default": {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      },
      "monday": {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      },
      "tuesday": {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      },
      "wednesday": {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      },
      "thursday": {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      },
      "friday": {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      },
      "saturday": {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      },
      "sunday": {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      },
      "holiday": {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      }
    }
}
```


```json{
    "data": {
      "referenceNumber": "abc123",
      "name": "Spring fountains Inc.",
      "address": "55 Springs road, BR1 4FG, Brighton",
      "w3wAddress": "///rival.mirror.helps",
      "postcode": "BR1 4FG",
      "latitude": 0,
      "longitude": 0,
      "isVerified": true,
      "isValid": true,
      "description": "string",
      "clientName": "null",
      "primaryTelephone": "string",
      "secondaryTelephone": "string",
      "email": "string",
      "website": "string",
      "settings": {
        "allowSMS": true,
        "allowEmail": true,
        "fixedTimePerAddress": 0,
        "fixedTimePerOrder": 0,
        "timePerCapacityDelivery": 0,
        "preferredDriverReferences": [
          "string"
        ],
        "preferredDriverNames": [
          "string"
        ],
        "vehicleRequirementsReferences": [
          "string"
        ]
      },
      "availability": {
        "monday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "tuesday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "wednesday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "thursday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "friday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "saturday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "sunday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "holiday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "default": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        }
      },
      "created": "2019-08-24T14:15:22Z",
      "updated": "2019-08-24T14:15:22Z"
    },
    "warnings": [
      {
        "code": "string",
        "name": "string",
        "details": "string",
        "field": "string"
      }
    ]
}
```


<a name="delete-a-customer-location"></a>
## Delete a customer location

### Method
`DELETE`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/locations/{reference}`

<a name="delete-a-location"></a>
## Delete a location

### Request

### Path Parameters

### Responses

| Code | Description |
|------|-------------|
| `200` | - |
| `412` | The location was deleted |

<a name="update-a-customer-location"></a>
## Update a customer location

### Method
`PUT`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/locations/{reference}`

<a name="update-a-location"></a>
## Update a location

### Request

### Path Parameters

#### Body

Content Type: `application/json`

### Description
Spring fountains Inc.

### Description
TimeWindow

### Description
TimeWindow

### Description
TimeWindow

### Description
TimeWindow

### Description
TimeWindow

### Description
TimeWindow

### Description
TimeWindow

### Description
TimeWindow

### Description
TimeWindow

### Responses

| Code | Description |
|------|-------------|
| `200` | - |
| `404` | Location successfully updated |

#### Body

Content Type: `application/json`
| `200` | - |

### Description
An integer warning code

### Description
Any additional details that the warning message may carry.

### Description
Location

### Description
Spring fountains Inc.

```json{
    "referenceNumber": "abc123",
    "name": "Spring fountains Inc.",
    "address": "55 Springs road, BR1 4FG, Brighton",
    "w3wAddress": "///rival.mirror.helps",
    "postcode": "BR1 4FG",
    "latitude": 0,
    "longitude": 0,
    "description": "string",
    "clientName": "null",
    "primaryTelephone": "string",
    "secondaryTelephone": "string",
    "email": "string",
    "website": "string",
    "settings": {
      "allowSMS": true,
      "allowEmail": true,
      "fixedTimePerAddress": 0,
      "fixedTimePerOrder": 0,
      "timePerCapacityDelivery": 0,
      "preferredDriverReferences": [
        "string"
      ],
      "vehicleRequirementsReferences": [
        "string"
      ]
    },
    "availability": {
      "monday": {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      },
      "tuesday": {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      },
      "wednesday": {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      },
      "thursday": {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      },
      "friday": {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      },
      "saturday": {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      },
      "sunday": {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      },
      "holiday": {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      },
      "default": {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      }
    },
    "created": "2019-08-24T14:15:22Z",
    "updated": "2019-08-24T14:15:22Z"
}
```


```json{
    "warnings": [
      {
        "code": "string",
        "name": "string",
        "details": "string",
        "field": "string"
      }
    ],
    "data": {
      "referenceNumber": "abc123",
      "name": "Spring fountains Inc.",
      "address": "55 Springs road, BR1 4FG, Brighton",
      "w3wAddress": "///rival.mirror.helps",
      "postcode": "BR1 4FG",
      "latitude": 0,
      "longitude": 0,
      "isVerified": true,
      "isValid": true,
      "description": "string",
      "clientName": "null",
      "primaryTelephone": "string",
      "secondaryTelephone": "string",
      "email": "string",
      "website": "string",
      "settings": {
        "allowSMS": true,
        "allowEmail": true,
        "fixedTimePerAddress": 0,
        "fixedTimePerOrder": 0,
        "timePerCapacityDelivery": 0,
        "preferredDriverReferences": [
          "string"
        ],
        "preferredDriverNames": [
          "string"
        ],
        "vehicleRequirementsReferences": [
          "string"
        ]
      },
      "availability": {
        "monday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "tuesday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "wednesday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "thursday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "friday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "saturday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "sunday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "holiday": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        },
        "default": {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        }
      },
      "created": "2019-08-24T14:15:22Z",
      "updated": "2019-08-24T14:15:22Z"
    }
}
```


<a name="get-a-list-of-distribution-centres"></a>
## Get a list of distribution centres

### Method
`GET`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/distributionCentres`

### Request

### Query Parameters

### Description
How many records to return

### Description
How many records to skip

### Responses

| Code | Description |
|------|-------------|
| `200` | List of distribution centeres in account |

#### Body

Content Type: `application/json`

### Description
PagingLinks

### Description
Relative URL of the previous page of results. Use this to navigate back to the previous page.Show all...

### Description
Relative URL of the next page of results. Use this to navigate to the next page.Show all...

```json{
    "data": [
      {
        "referenceNumber": "string",
        "name": "string",
        "address": "string"
      }
    ],
    "_links": {
      "prev": "/orders?offset=20",
      "next": "/orders?offset=40"
    },
    "offset": 0
}
```


<a name="get-a-list-of-drivers"></a>
## Get a list of drivers

### Method
`GET`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/drivers`

<a name="get-a-list-of-drivers"></a>
## Get a list of drivers

### Request

### Query Parameters

### Description
How many records to return

### Description
How many records to skip

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

#### Body

Content Type: `application/json`

### Description
How many records were skipped

### Description
PagingLinks

### Description
Relative URL of the previous page of results. Use this to navigate back to the previous page.Show all...

### Description
Relative URL of the next page of results. Use this to navigate to the next page.Show all...

```json{
    "data": [
      {
        "referenceNumber": "string",
        "name": "string",
        "assignedVehicleReference": "string",
        "assignedVehicleName": "string",
        "distributionCentreReference": "string",
        "distributionCentreName": "string"
      }
    ],
    "offset": 0,
    "_links": {
      "prev": "/orders?offset=20",
      "next": "/orders?offset=40"
    }
}
```


<a name="create-a-driver"></a>
## Create a driver

### Method
`POST`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/drivers`

<a name="create-a-new-driver"></a>
## Create a new driver

### Request

#### Body

Content Type: `application/json`

### Description
Multiple of:

### Description
Allowed values:

### Description
Required if startOfDayLocation = 'address'. Will be geocoded.

### Description
Allowed values:

### Description
Allowed values:

### Description
Required if startOfDayLocation = 'address'. Will be geocoded.

### Description
Allowed values:

### Description
In seconds. Can be null (the DC default is used if null)

### Description
In seconds. Can be null (the DC default is used if null)

### Description
In seconds. Can be null (the DC default is used if null)

### Description
DriverAvailabilityDay

### Description
DriverAvailabilityDay

### Description
DriverAvailabilityDay

### Description
DriverAvailabilityDay

### Description
DriverAvailabilityDay

### Description
DriverAvailabilityDay

### Description
DriverAvailabilityDay

### Description
DriverAvailabilityDay

### Description
DriverAvailabilityDay

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

### Description
Driver successfully created

#### Body

Content Type: `application/json`
| `200` | - |

### Description
An integer warning code

### Description
Any additional details that the warning message may carry.

### Description
DriverDetails

### Description
Multiple of:

### Description
Allowed values:

### Description
Required if startOfDayLocation = 'address'. Will be geocoded.

### Description
Allowed values:

### Description
Allowed values:

### Description
Required if startOfDayLocation = 'address'. Will be geocoded.

### Description
Allowed values:

### Description
In seconds. Can be null (the DC default is used if null)

### Description
In seconds. Can be null (the DC default is used if null)

### Description
In seconds. Can be null (the DC default is used if null)

```json{
    "referenceNumber": "string",
    "name": "string",
    "comment": "string",
    "telephone": "string",
    "assignedVehicleReference": "string",
    "costPerHour": 0,
    "distributionCentreReference": "string",
    "distributionCentreName": "string",
    "territories": [
      "string"
    ],
    "startOfDayLocation": "DC",
    "startOfDayAddress": "string",
    "visitDistributionCentreStart": "TO_RELOAD",
    "endOfDayLocation": "DC",
    "endOfDayAddress": "string",
    "visitDistributionCentreEnd": "NO",
    "drivingLimit": 0,
    "runDurationLimit": 0,
    "dutyTimeLimit": 0,
    "availability": {
      "monday": {
        "startDay": "SAME_DAY",
        "startTime": "14:15:22Z",
        "rigidStart": true,
        "endDay": "SAME_DAY",
        "endTime": "14:15:22Z"
      },
      "tuesday": {
        "startDay": "SAME_DAY",
        "startTime": "14:15:22Z",
        "rigidStart": true,
        "endDay": "SAME_DAY",
        "endTime": "14:15:22Z"
      },
      "wednesday": {
        "startDay": "SAME_DAY",
        "startTime": "14:15:22Z",
        "rigidStart": true,
        "endDay": "SAME_DAY",
        "endTime": "14:15:22Z"
      },
      "thursday": {
        "startDay": "SAME_DAY",
        "startTime": "14:15:22Z",
        "rigidStart": true,
        "endDay": "SAME_DAY",
        "endTime": "14:15:22Z"
      },
      "friday": {
        "startDay": "SAME_DAY",
        "startTime": "14:15:22Z",
        "rigidStart": true,
        "endDay": "SAME_DAY",
        "endTime": "14:15:22Z"
      },
      "saturday": {
        "startDay": "SAME_DAY",
        "startTime": "14:15:22Z",
        "rigidStart": true,
        "endDay": "SAME_DAY",
        "endTime": "14:15:22Z"
      },
      "sunday": {
        "startDay": "SAME_DAY",
        "startTime": "14:15:22Z",
        "rigidStart": true,
        "endDay": "SAME_DAY",
        "endTime": "14:15:22Z"
      },
      "default": {
        "startDay": "SAME_DAY",
        "startTime": "14:15:22Z",
        "rigidStart": true,
        "endDay": "SAME_DAY",
        "endTime": "14:15:22Z"
      },
      "holiday": {
        "startDay": "SAME_DAY",
        "startTime": "14:15:22Z",
        "rigidStart": true,
        "endDay": "SAME_DAY",
        "endTime": "14:15:22Z"
      }
    }
}
```


```json{
    "warnings": [
      {
        "code": "string",
        "name": "string",
        "details": "string",
        "field": "string"
      }
    ],
    "data": {
      "referenceNumber": "string",
      "name": "string",
      "comment": "string",
      "telephone": "string",
      "assignedVehicleReference": "string",
      "assignedVehicleName": "string",
      "costPerHour": 0,
      "distributionCentreReference": "string",
      "distributionCentreName": "string",
      "territories": [
        "string"
      ],
      "startOfDayLocation": "DC",
      "startOfDayAddress": "string",
      "visitDistributionCentreStart": "TO_RELOAD",
      "endOfDayLocation": "DC",
      "endOfDayAddress": "string",
      "visitDistributionCentreEnd": "NO",
      "drivingLimit": 0,
      "runDurationLimit": 0,
      "dutyTimeLimit": 0,
      "availability": {
        "monday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "tuesday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "wednesday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "thursday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "friday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "saturday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "sunday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "default": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "holiday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        }
      }
    }
}
```


<a name="get-driver-details"></a>
## Get driver details

### Method
`GET`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/drivers/{reference}`

<a name="get-details-of-a-single-driver-by-reference."></a>
## Get details of a single driver by reference.

### Request

### Path Parameters

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

#### Body

Content Type: `application/json`
| `200` | - |

### Description
DriverDetails

### Description
Multiple of:

### Description
Allowed values:

### Description
Required if startOfDayLocation = 'address'. Will be geocoded.

### Description
Allowed values:

### Description
Allowed values:

### Description
Required if startOfDayLocation = 'address'. Will be geocoded.

### Description
Allowed values:

### Description
In seconds. Can be null (the DC default is used if null)

### Description
In seconds. Can be null (the DC default is used if null)

### Description
In seconds. Can be null (the DC default is used if null)

```json{
    "data": {
      "referenceNumber": "string",
      "name": "string",
      "comment": "string",
      "telephone": "string",
      "assignedVehicleReference": "string",
      "assignedVehicleName": "string",
      "costPerHour": 0,
      "distributionCentreReference": "string",
      "distributionCentreName": "string",
      "territories": [
        "string"
      ],
      "startOfDayLocation": "DC",
      "startOfDayAddress": "string",
      "visitDistributionCentreStart": "TO_RELOAD",
      "endOfDayLocation": "DC",
      "endOfDayAddress": "string",
      "visitDistributionCentreEnd": "NO",
      "drivingLimit": 0,
      "runDurationLimit": 0,
      "dutyTimeLimit": 0,
      "availability": {
        "monday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "tuesday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "wednesday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "thursday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "friday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "saturday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "sunday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "default": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "holiday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        }
      }
    }
}
```


<a name="partially-update-a-driver"></a>
## Partially update a driver

### Method
`PATCH`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/drivers/{reference}`

<a name="update-certain-fields-of-a-driver.-all-fields-are-optional,-only-specified-fields-are-updated."></a>
## Update certain fields of a driver. All fields are optional, only specified fields are updated.

### Request

### Path Parameters

#### Body

Content Type: `application/json`

### Description
Multiple of:

### Description
Allowed values:

### Description
Required if startOfDayLocation = 'address'. Will be geocoded.

### Description
Allowed values:

### Description
Allowed values:

### Description
Required if startOfDayLocation = 'address'. Will be geocoded.

### Description
Allowed values:

### Description
In seconds. Can be null (the DC default is used if null)

### Description
In seconds. Can be null (the DC default is used if null)

### Description
In seconds. Can be null (the DC default is used if null)

### Description
DriverAvailabilityDay

### Description
DriverAvailabilityDay

### Description
DriverAvailabilityDay

### Description
DriverAvailabilityDay

### Description
DriverAvailabilityDay

### Description
DriverAvailabilityDay

### Description
DriverAvailabilityDay

### Description
DriverAvailabilityDay

### Description
DriverAvailabilityDay

### Responses

| Code | Description |
|------|-------------|
| `200` | - |
| `404` | The driver was updated successfully. Returns the details of the updated record. |

#### Body

Content Type: `application/json`
| `200` | - |

### Description
DriverDetails

### Description
Multiple of:

### Description
Allowed values:

### Description
Required if startOfDayLocation = 'address'. Will be geocoded.

### Description
Allowed values:

### Description
Allowed values:

### Description
Required if startOfDayLocation = 'address'. Will be geocoded.

### Description
Allowed values:

### Description
In seconds. Can be null (the DC default is used if null)

### Description
In seconds. Can be null (the DC default is used if null)

### Description
In seconds. Can be null (the DC default is used if null)

### Description
An integer warning code

### Description
Any additional details that the warning message may carry.

```json{
    "referenceNumber": "string",
    "name": "string",
    "comment": "string",
    "telephone": "string",
    "assignedVehicleReference": "string",
    "costPerHour": 0,
    "distributionCentreReference": "string",
    "distributionCentreName": "string",
    "territories": [
      "string"
    ],
    "startOfDayLocation": "DC",
    "startOfDayAddress": "string",
    "visitDistributionCentreStart": "TO_RELOAD",
    "endOfDayLocation": "DC",
    "endOfDayAddress": "string",
    "visitDistributionCentreEnd": "NO",
    "drivingLimit": 0,
    "runDurationLimit": 0,
    "dutyTimeLimit": 0,
    "availability": {
      "monday": {
        "startDay": "SAME_DAY",
        "startTime": "14:15:22Z",
        "rigidStart": true,
        "endDay": "SAME_DAY",
        "endTime": "14:15:22Z"
      },
      "tuesday": {
        "startDay": "SAME_DAY",
        "startTime": "14:15:22Z",
        "rigidStart": true,
        "endDay": "SAME_DAY",
        "endTime": "14:15:22Z"
      },
      "wednesday": {
        "startDay": "SAME_DAY",
        "startTime": "14:15:22Z",
        "rigidStart": true,
        "endDay": "SAME_DAY",
        "endTime": "14:15:22Z"
      },
      "thursday": {
        "startDay": "SAME_DAY",
        "startTime": "14:15:22Z",
        "rigidStart": true,
        "endDay": "SAME_DAY",
        "endTime": "14:15:22Z"
      },
      "friday": {
        "startDay": "SAME_DAY",
        "startTime": "14:15:22Z",
        "rigidStart": true,
        "endDay": "SAME_DAY",
        "endTime": "14:15:22Z"
      },
      "saturday": {
        "startDay": "SAME_DAY",
        "startTime": "14:15:22Z",
        "rigidStart": true,
        "endDay": "SAME_DAY",
        "endTime": "14:15:22Z"
      },
      "sunday": {
        "startDay": "SAME_DAY",
        "startTime": "14:15:22Z",
        "rigidStart": true,
        "endDay": "SAME_DAY",
        "endTime": "14:15:22Z"
      },
      "default": {
        "startDay": "SAME_DAY",
        "startTime": "14:15:22Z",
        "rigidStart": true,
        "endDay": "SAME_DAY",
        "endTime": "14:15:22Z"
      },
      "holiday": {
        "startDay": "SAME_DAY",
        "startTime": "14:15:22Z",
        "rigidStart": true,
        "endDay": "SAME_DAY",
        "endTime": "14:15:22Z"
      }
    }
}
```


```json{
    "data": {
      "referenceNumber": "string",
      "name": "string",
      "comment": "string",
      "telephone": "string",
      "assignedVehicleReference": "string",
      "assignedVehicleName": "string",
      "costPerHour": 0,
      "distributionCentreReference": "string",
      "distributionCentreName": "string",
      "territories": [
        "string"
      ],
      "startOfDayLocation": "DC",
      "startOfDayAddress": "string",
      "visitDistributionCentreStart": "TO_RELOAD",
      "endOfDayLocation": "DC",
      "endOfDayAddress": "string",
      "visitDistributionCentreEnd": "NO",
      "drivingLimit": 0,
      "runDurationLimit": 0,
      "dutyTimeLimit": 0,
      "availability": {
        "monday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "tuesday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "wednesday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "thursday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "friday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "saturday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "sunday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "default": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "holiday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        }
      }
    },
    "warnings": [
      {
        "code": "string",
        "name": "string",
        "details": "string",
        "field": "string"
      }
    ]
}
```


<a name="delete-a-driver"></a>
## Delete a driver

### Method
`DELETE`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/drivers/{reference}`

<a name="delete-a-driver"></a>
## Delete a driver

### Request

### Path Parameters

### Responses

| Code | Description |
|------|-------------|
| `200` | - |
| `412` | Driver was deleted |

#### Body

Content Type: `application/json`

### Description
An integer warning code

### Description
Any additional details that the warning message may carry.

```json{
    "warnings": [
      {
        "code": "string",
        "name": "string",
        "details": "string",
        "field": "string"
      }
    ]
}
```


<a name="update-a-driver"></a>
## Update a driver

### Method
`PUT`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/drivers/{reference}`

<a name="update-a-driver-by-reference"></a>
## Update a driver by reference

### Request

### Path Parameters

#### Body

Content Type: `application/json`

### Description
Multiple of:

### Description
Allowed values:

### Description
Required if startOfDayLocation = 'address'. Will be geocoded.

### Description
Allowed values:

### Description
Allowed values:

### Description
Required if startOfDayLocation = 'address'. Will be geocoded.

### Description
Allowed values:

### Description
In seconds. Can be null (the DC default is used if null)

### Description
In seconds. Can be null (the DC default is used if null)

### Description
In seconds. Can be null (the DC default is used if null)

### Description
DriverAvailabilityDay

### Description
DriverAvailabilityDay

### Description
DriverAvailabilityDay

### Description
DriverAvailabilityDay

### Description
DriverAvailabilityDay

### Description
DriverAvailabilityDay

### Description
DriverAvailabilityDay

### Description
DriverAvailabilityDay

### Description
DriverAvailabilityDay

### Responses

| Code | Description |
|------|-------------|
| `200` | - |
| `404` | Successfully udpated |

#### Body

Content Type: `application/json`
| `200` | - |

### Description
An integer warning code

### Description
Any additional details that the warning message may carry.

### Description
DriverDetails

### Description
Multiple of:

### Description
Allowed values:

### Description
Required if startOfDayLocation = 'address'. Will be geocoded.

### Description
Allowed values:

### Description
Allowed values:

### Description
Required if startOfDayLocation = 'address'. Will be geocoded.

### Description
Allowed values:

### Description
In seconds. Can be null (the DC default is used if null)

### Description
In seconds. Can be null (the DC default is used if null)

### Description
In seconds. Can be null (the DC default is used if null)

```json{
    "referenceNumber": "string",
    "name": "string",
    "comment": "string",
    "telephone": "string",
    "assignedVehicleReference": "string",
    "costPerHour": 0,
    "distributionCentreReference": "string",
    "distributionCentreName": "string",
    "territories": [
      "string"
    ],
    "startOfDayLocation": "DC",
    "startOfDayAddress": "string",
    "visitDistributionCentreStart": "TO_RELOAD",
    "endOfDayLocation": "DC",
    "endOfDayAddress": "string",
    "visitDistributionCentreEnd": "NO",
    "drivingLimit": 0,
    "runDurationLimit": 0,
    "dutyTimeLimit": 0,
    "availability": {
      "monday": {
        "startDay": "SAME_DAY",
        "startTime": "14:15:22Z",
        "rigidStart": true,
        "endDay": "SAME_DAY",
        "endTime": "14:15:22Z"
      },
      "tuesday": {
        "startDay": "SAME_DAY",
        "startTime": "14:15:22Z",
        "rigidStart": true,
        "endDay": "SAME_DAY",
        "endTime": "14:15:22Z"
      },
      "wednesday": {
        "startDay": "SAME_DAY",
        "startTime": "14:15:22Z",
        "rigidStart": true,
        "endDay": "SAME_DAY",
        "endTime": "14:15:22Z"
      },
      "thursday": {
        "startDay": "SAME_DAY",
        "startTime": "14:15:22Z",
        "rigidStart": true,
        "endDay": "SAME_DAY",
        "endTime": "14:15:22Z"
      },
      "friday": {
        "startDay": "SAME_DAY",
        "startTime": "14:15:22Z",
        "rigidStart": true,
        "endDay": "SAME_DAY",
        "endTime": "14:15:22Z"
      },
      "saturday": {
        "startDay": "SAME_DAY",
        "startTime": "14:15:22Z",
        "rigidStart": true,
        "endDay": "SAME_DAY",
        "endTime": "14:15:22Z"
      },
      "sunday": {
        "startDay": "SAME_DAY",
        "startTime": "14:15:22Z",
        "rigidStart": true,
        "endDay": "SAME_DAY",
        "endTime": "14:15:22Z"
      },
      "default": {
        "startDay": "SAME_DAY",
        "startTime": "14:15:22Z",
        "rigidStart": true,
        "endDay": "SAME_DAY",
        "endTime": "14:15:22Z"
      },
      "holiday": {
        "startDay": "SAME_DAY",
        "startTime": "14:15:22Z",
        "rigidStart": true,
        "endDay": "SAME_DAY",
        "endTime": "14:15:22Z"
      }
    }
}
```


```json{
    "warnings": [
      {
        "code": "string",
        "name": "string",
        "details": "string",
        "field": "string"
      }
    ],
    "data": {
      "referenceNumber": "string",
      "name": "string",
      "comment": "string",
      "telephone": "string",
      "assignedVehicleReference": "string",
      "assignedVehicleName": "string",
      "costPerHour": 0,
      "distributionCentreReference": "string",
      "distributionCentreName": "string",
      "territories": [
        "string"
      ],
      "startOfDayLocation": "DC",
      "startOfDayAddress": "string",
      "visitDistributionCentreStart": "TO_RELOAD",
      "endOfDayLocation": "DC",
      "endOfDayAddress": "string",
      "visitDistributionCentreEnd": "NO",
      "drivingLimit": 0,
      "runDurationLimit": 0,
      "dutyTimeLimit": 0,
      "availability": {
        "monday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "tuesday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "wednesday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "thursday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "friday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "saturday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "sunday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "default": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        },
        "holiday": {
          "startDay": "SAME_DAY",
          "startTime": "14:15:22Z",
          "rigidStart": true,
          "endDay": "SAME_DAY",
          "endTime": "14:15:22Z"
        }
      }
    }
}
```


<a name="get-execution-details-of-an-order"></a>
## Get execution details of an order

### Method
`GET`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/orders/{orderReference}/execution`

### Description
Returns execution information for a particular order.

### Request

### Path Parameters

### Responses

| Code | Description |
|------|-------------|
| `200` | - |
| `404` | Successful response. If the order is not allocated, all fields (except status) will be null. |

#### Body

Content Type: `application/json`

### Description
OrderExecutionInfo

### Description
Information about how the order is executed. Includes the order's allocation information, status, real-time ETA, actual and reported times

```json{
    "data": {
      "orderReferenceNumber": "string",
      "assignedDriverReference": "string",
      "assignedDriverName": "string",
      "assignedVehicleReference": "string",
      "assignedVehicleName": "string",
      "plannedArrivalTime": "2019-08-24T14:15:22Z",
      "plannedCompletionTime": "2019-08-24T14:15:22Z",
      "stopNumber": 0,
      "totalStopsInRun": 0,
      "eta": "2019-08-24T14:15:22Z",
      "factArrivalTimeGPS": "2019-08-24T14:15:22Z",
      "factCompletionTimeGPS": "2019-08-24T14:15:22Z",
      "factArrivalTimeReported": "2019-08-24T14:15:22Z",
      "factCompletionTimeReported": "2019-08-24T14:15:22Z",
      "failReason": "string",
      "failComment": "string",
      "status": "string",
      "runNumber": 0
    }
}
```


<a name="get-order-items-for-an-order"></a>
## Get order items for an order

### Method
`GET`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/orders/{orderReference}/items`

### Request

### Path Parameters

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

### Description
Successful response.

#### Body

Content Type: `application/json`

### Description
OrderItemsInfo

### Description
An object containing items information for a particular order.

### Description
An object that represents an order item.

### Description
ItemsStatus

### Description
Allowed values:

```json{
    "data": {
      "orderReferenceNumber": "string",
      "orderItems": [
        {
          "itemReferenceNumber": "string",
          "orderReferenceNumber": "string",
          "name": "string",
          "description": "string",
          "barcode": "string",
          "status": "CHECKED",
          "rejectReason": "string",
          "rejectComment": "string",
          "pricePerUnit": 0,
          "plannedQuantity": 0,
          "factQuantity": 0,
          "totalAmount": 0,
          "height": 0,
          "width": 0,
          "length": 0,
          "weight": 0,
          "volume": 0
        }
      ],
      "plannedItemsCount": 0,
      "factItemsCount": 0,
      "ItemsStatus": "IN_FULL"
    }
}
```


### Method
`GET`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/orders/{orderReference}/attachments`

### Description
View order attachments details

### Request

### Path Parameters

### Description
Order reference

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

### Description
Successful response.

#### Body

Content Type: `application/json`

### Description
OrderAttachmentsInfo

### Description
An object representing an photo attachment to an order

```json{
    "data": {
      "orderReferenceNumber": "string",
      "attachments": [
        {
          "attachmentReferenceNumber": "string",
          "orderReferenceNumber": "string",
          "comment": "string",
          "imageSmall": "http://example.com",
          "imageFull": "http://example.com"
        }
      ]
    }
}
```


<a name="get-pod-details-for-an-order"></a>
## Get POD details for an order

### Method
`GET`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/orders/{orderReference}/pod`

<a name="get-pod-details,-including-signature-and-its-metadata."></a>
## Get POD details, including signature and its metadata.

### Request

### Path Parameters

### Description
Order reference

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

### Description
Successful response. If the order does not have the relevant information, the fields are returned with null values.

#### Body

Content Type: `application/json`

```json{
    "data": {
      "orderReferenceNumber": "string",
      "signatoryName": "string",
      "signatureTime": "2019-08-24T14:15:22Z",
      "signatureImage": "string"
    }
}
```


<a name="get-tracking-info-for-an-order"></a>
## Get tracking info for an order

### Method
`GET`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/orders/{orderReference}/tracking`

### Description
Will return the current position of the delivery. It will match the position of the delivery vehicle if the order's status is between DELIVERY_STARTED / PICKUP_STARTED and COMPLETED / FAILED

### Request

### Path Parameters

### Description
Order reference

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

#### Body

Content Type: `application/json`

### Description
OrderTrackingInfo

### Description
GeoPosition

### Description
An object that describes a geographical position with latitude and longitude

```json{
    "data": {
      "orderReferenceNumber": "string",
      "currentPosition": {
        "latitude": 0,
        "longitude": 0
      },
      "status": "string"
    }
}
```


<a name="get-a-list-of-orders"></a>
## Get a list of orders

### Method
`GET`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/orders`

### Request

### Query Parameters

### Description
Unique reference number of a consignment to link a delivery and collection.

### Description
Allowed values:

<a name="get-all-the-orders-for-a-specific-territory"></a>
## Get all the orders for a specific territory

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

### Description
Success

#### Body

Content Type: `application/json`
| `200` | - |

### Description
Used to group P&D orders in pairs. If set - assumes consignmentLinkType = "PickupAndDeliver".

### Description
Allowed values:

### Description
Allowed values:

### Description
In whole seconds

### Description
Sent only if expand parameter includes ATTRIBUTES

### Description
Sent only if expand parameter includes STATUSES

### Description
Allowed values:

### Description
Sent only if expand parameter includes STATUSES

### Description
WidgetTrackingDetails

### Description
Object that contains an order tracking ID and URL from the tracking widget. Available in /orders only when expand parameter WIDGET is set.

### Description
PagingLinks

### Description
Relative URL of the previous page of results. Use this to navigate back to the previous page.Show all...

### Description
Relative URL of the next page of results. Use this to navigate to the next page.Show all...

```json{
    "data": [
      {
        "referenceNumber": "string",
        "consignmentReference": "string",
        "distributionCentreReference": "string",
        "distributionCentreName": "string",
        "task": "DELIVERY",
        "priority": "NORMAL",
        "clientName": "string",
        "contactPerson": "string",
        "customerLocation": {
          "referenceNumber": "string",
          "name": "string",
          "address": "string",
          "latitude": 0,
          "longitude": 0,
          "w3wAddress": "string"
        },
        "capacity1": 0,
        "capacity2": 0,
        "operationDuration": 0,
        "customFields": {
          "": "string"
        },
        "status": "UNALLOCATED",
        "statusLastUpdated": "2019-08-24T14:15:22Z",
        "widgetTrackingDetails": {
          "trackingId": "string",
          "externalTrackingUri": "http://example.com"
        }
      }
    ],
    "offset": 0,
    "_links": {
      "prev": "/orders?offset=20",
      "next": "/orders?offset=40"
    }
}
```


<a name="create-an-order"></a>
## Create an order

### Method
`POST`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/orders`

### Request

#### Body

Content Type: `application/json`

### Description
To streamline the planning process, Pickup and Delivery orders can be associated through a unique consignmentReference, establishing a 1:1 relationship between a delivery and collection task.

### Description
Allowed values:

### Description
Allowed values:

### Description
Additional emails for order notifications

### Description
If specified, none of the other fields of CL are mandatory. Will try to find the location by reference and fail if not found.Show all...

### Description
If not set, true is assumed for both.

### Description
Allowed values:

### Description
You can provide either orderDate or exact Time Windows if TimeWindows is set orderDate will be ignored

### Description
You can provide either orderDate or exact Time Windows if timeWindows is set orderDate will be ignored Setting an orderDate will create a order with default account time windows

### Description
In whole seconds

### Description
On object containing a key-value pair for each custom field. The tech name is used as a key.

### Description
An object that represents an order item.

### Description
Allowed values:

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

```json{
    "referenceNumber": "string",
    "consignmentReference": "string",
    "distributionCentreReference": "string",
    "task": "DELIVERY",
    "priority": "NORMAL",
    "vehicleRequirements": [
      "string"
    ],
    "additionalInstructions": "string",
    "clientName": "string",
    "contactPerson": "string",
    "contactNumber": "string",
    "contactEmail": "user@example.com",
    "additionalContactEmails": [
      "user@example.com"
    ],
    "customerLocation": {
      "referenceNumber": "string",
      "name": "string",
      "address": "string",
      "latitude": 0,
      "longitude": 0,
      "w3wAddress": "///rival.mirror.helps"
    },
    "notificationPreferences": {
      "allowSMS": true,
      "allowEmail": true
    },
    "stopSequence": "ANY",
    "timeWindows": [
      {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      }
    ],
    "orderDate": "2023-03-01",
    "capacity1": 0,
    "capacity2": 0,
    "operationDuration": 0,
    "customFields": {},
    "orderItems": [
      {
        "itemReferenceNumber": "string",
        "orderReferenceNumber": "string",
        "name": "string",
        "description": "string",
        "barcode": "string",
        "status": "CHECKED",
        "rejectReason": "string",
        "rejectComment": "string",
        "pricePerUnit": 0,
        "plannedQuantity": 0,
        "factQuantity": 0,
        "totalAmount": 0,
        "height": 0,
        "width": 0,
        "length": 0,
        "weight": 0,
        "volume": 0
      }
    ],
    "price": 10
}
```


<a name="get-order-details"></a>
## Get order details

### Method
`GET`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/orders/{orderReference}`

### Request

### Path Parameters

### Responses

| Code | Description |
|------|-------------|
| `200` | - |
| `409` | OK |

#### Body

Content Type: `application/json`
| `200` | - |

### Description
OrderDetails

### Description
To streamline the planning process, Pickup and Delivery orders can be associated through a unique consignmentReference, establishing a 1:1 relationship between a delivery and collection task.

### Description
Allowed values:

### Description
Allowed values:

### Description
Additional emails for order notifications

### Description
If not set, true is assumed for both.

### Description
If order belongs to territory, this field will contain the reference of that territory

### Description
Allowed values:

### Description
You can provide either orderDate or exact Time Windows if TimeWindows is set orderDate will be ignored

### Description
In whole seconds

### Description
On object containing a key-value pair for each custom field. The tech name is used as a key.

### Description
An object that represents an order item.

```json{
    "data": {
      "referenceNumber": "string",
      "consignmentReference": "string",
      "distributionCentreReference": "string",
      "distributionCentreName": "string",
      "task": "DELIVERY",
      "priority": "NORMAL",
      "vehicleRequirements": [
        "string"
      ],
      "additionalInstructions": "string",
      "clientName": "string",
      "contactPerson": "string",
      "contactNumber": "string",
      "contactEmail": "user@example.com",
      "additionalContactEmails": [
        "user@example.com"
      ],
      "customerLocation": {
        "referenceNumber": "string",
        "name": "string",
        "address": "string",
        "latitude": 0,
        "longitude": 0,
        "w3wAddress": "///rival.mirror.helps"
      },
      "notificationPreferences": {
        "allowSMS": true,
        "allowEmail": true
      },
      "territoryReference": "territoryRef",
      "stopSequence": "ANY",
      "timeWindows": [
        {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        }
      ],
      "capacity1": 0,
      "capacity2": 0,
      "operationDuration": 0,
      "customFields": {},
      "orderItems": [
        {
          "itemReferenceNumber": "string",
          "orderReferenceNumber": "string",
          "name": "string",
          "description": "string",
          "barcode": "string",
          "status": "CHECKED",
          "rejectReason": "string",
          "rejectComment": "string",
          "pricePerUnit": 0,
          "plannedQuantity": 0,
          "factQuantity": 0,
          "totalAmount": 0,
          "height": 0,
          "width": 0,
          "length": 0,
          "weight": 0,
          "volume": 0
        }
      ],
      "price": 10
    }
}
```


<a name="update-an-order"></a>
## Update an order

### Method
`PUT`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/orders/{orderReference}`

### Request

### Path Parameters

#### Body

Content Type: `application/json`

### Description
To streamline the planning process, Pickup and Delivery orders can be associated through a unique consignmentReference, establishing a 1:1 relationship between a delivery and collection task.

### Description
Allowed values:

### Description
Allowed values:

### Description
Additional emails for order notifications

### Description
If specified, none of the other fields of CL are mandatory. Will try to find the location by reference and fail if not found.Show all...

### Description
If not set, true is assumed for both.

### Description
Allowed values:

### Description
You can provide either orderDate or exact Time Windows if TimeWindows is set orderDate will be ignored

### Description
You can provide either orderDate or exact Time Windows if timeWindows is set orderDate will be ignored Setting an orderDate will create a order with default account time windows

### Description
In whole seconds

### Description
On object containing a key-value pair for each custom field. The tech name is used as a key.

### Description
An object that represents an order item.

### Description
Allowed values:

### Responses

| Code | Description |
|------|-------------|
| `200` | - |
| `404` | - |
| `412` | Successfully updated. |

#### Body

Content Type: `application/json`
| `200` | - |

### Description
OrderDetails

### Description
To streamline the planning process, Pickup and Delivery orders can be associated through a unique consignmentReference, establishing a 1:1 relationship between a delivery and collection task.

### Description
Allowed values:

### Description
Allowed values:

### Description
Additional emails for order notifications

### Description
If not set, true is assumed for both.

### Description
If order belongs to territory, this field will contain the reference of that territory

### Description
Allowed values:

### Description
You can provide either orderDate or exact Time Windows if TimeWindows is set orderDate will be ignored

### Description
In whole seconds

### Description
On object containing a key-value pair for each custom field. The tech name is used as a key.

### Description
An object that represents an order item.

### Description
An integer warning code

### Description
Any additional details that the warning message may carry.

```json{
    "referenceNumber": "string",
    "consignmentReference": "string",
    "distributionCentreReference": "string",
    "task": "DELIVERY",
    "priority": "NORMAL",
    "vehicleRequirements": [
      "string"
    ],
    "additionalInstructions": "string",
    "clientName": "string",
    "contactPerson": "string",
    "contactNumber": "string",
    "contactEmail": "user@example.com",
    "additionalContactEmails": [
      "user@example.com"
    ],
    "customerLocation": {
      "referenceNumber": "string",
      "name": "string",
      "address": "string",
      "latitude": 0,
      "longitude": 0,
      "w3wAddress": "///rival.mirror.helps"
    },
    "notificationPreferences": {
      "allowSMS": true,
      "allowEmail": true
    },
    "stopSequence": "ANY",
    "timeWindows": [
      {
        "start": "2019-08-24T14:15:22Z",
        "end": "2019-08-24T14:15:22Z"
      }
    ],
    "orderDate": "2023-03-01",
    "capacity1": 0,
    "capacity2": 0,
    "operationDuration": 0,
    "customFields": {},
    "orderItems": [
      {
        "itemReferenceNumber": "string",
        "orderReferenceNumber": "string",
        "name": "string",
        "description": "string",
        "barcode": "string",
        "status": "CHECKED",
        "rejectReason": "string",
        "rejectComment": "string",
        "pricePerUnit": 0,
        "plannedQuantity": 0,
        "factQuantity": 0,
        "totalAmount": 0,
        "height": 0,
        "width": 0,
        "length": 0,
        "weight": 0,
        "volume": 0
      }
    ],
    "price": 10
}
```


```json{
    "data": {
      "referenceNumber": "string",
      "consignmentReference": "string",
      "distributionCentreReference": "string",
      "distributionCentreName": "string",
      "task": "DELIVERY",
      "priority": "NORMAL",
      "vehicleRequirements": [
        "string"
      ],
      "additionalInstructions": "string",
      "clientName": "string",
      "contactPerson": "string",
      "contactNumber": "string",
      "contactEmail": "user@example.com",
      "additionalContactEmails": [
        "user@example.com"
      ],
      "customerLocation": {
        "referenceNumber": "string",
        "name": "string",
        "address": "string",
        "latitude": 0,
        "longitude": 0,
        "w3wAddress": "///rival.mirror.helps"
      },
      "notificationPreferences": {
        "allowSMS": true,
        "allowEmail": true
      },
      "territoryReference": "territoryRef",
      "stopSequence": "ANY",
      "timeWindows": [
        {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        }
      ],
      "capacity1": 0,
      "capacity2": 0,
      "operationDuration": 0,
      "customFields": {},
      "orderItems": [
        {
          "itemReferenceNumber": "string",
          "orderReferenceNumber": "string",
          "name": "string",
          "description": "string",
          "barcode": "string",
          "status": "CHECKED",
          "rejectReason": "string",
          "rejectComment": "string",
          "pricePerUnit": 0,
          "plannedQuantity": 0,
          "factQuantity": 0,
          "totalAmount": 0,
          "height": 0,
          "width": 0,
          "length": 0,
          "weight": 0,
          "volume": 0
        }
      ],
      "price": 10
    },
    "warnings": [
      {
        "code": "string",
        "name": "string",
        "details": "string",
        "field": "string"
      }
    ]
}
```


<a name="partially-update-an-order"></a>
## Partially update an order

### Method
`PATCH`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/orders/{orderReference}`

### Description
Modify order using json-patch semantics IETF RFC-6902 For more informantion see http://jsonpatch.com/

### Description
You can modify order model with the set of json patch commands

### Description
You can see examples for manupulating order items in Body - 'examples' menu

### Request

### Path Parameters

#### Body

### Description
Valid JSON Patch request to modify the order

### Description
Allowed values:

### Description
Some Name

### Responses

| Code | Description |
|------|-------------|
| `200` | - |
| `404` | - |
| `412` | Success |

#### Body

Content Type: `application/json`
| `200` | - |

### Description
An integer warning code

### Description
Any additional details that the warning message may carry.

### Description
OrderDetails

### Description
To streamline the planning process, Pickup and Delivery orders can be associated through a unique consignmentReference, establishing a 1:1 relationship between a delivery and collection task.

### Description
Allowed values:

### Description
Allowed values:

### Description
Additional emails for order notifications

### Description
If not set, true is assumed for both.

### Description
If order belongs to territory, this field will contain the reference of that territory

### Description
Allowed values:

### Description
You can provide either orderDate or exact Time Windows if TimeWindows is set orderDate will be ignored

### Description
In whole seconds

### Description
On object containing a key-value pair for each custom field. The tech name is used as a key.

### Description
An object that represents an order item.

```json{
    "warnings": [
      {
        "code": "string",
        "name": "string",
        "details": "string",
        "field": "string"
      }
    ],
    "data": {
      "referenceNumber": "string",
      "consignmentReference": "string",
      "distributionCentreReference": "string",
      "distributionCentreName": "string",
      "task": "DELIVERY",
      "priority": "NORMAL",
      "vehicleRequirements": [
        "string"
      ],
      "additionalInstructions": "string",
      "clientName": "string",
      "contactPerson": "string",
      "contactNumber": "string",
      "contactEmail": "user@example.com",
      "additionalContactEmails": [
        "user@example.com"
      ],
      "customerLocation": {
        "referenceNumber": "string",
        "name": "string",
        "address": "string",
        "latitude": 0,
        "longitude": 0,
        "w3wAddress": "///rival.mirror.helps"
      },
      "notificationPreferences": {
        "allowSMS": true,
        "allowEmail": true
      },
      "territoryReference": "territoryRef",
      "stopSequence": "ANY",
      "timeWindows": [
        {
          "start": "2019-08-24T14:15:22Z",
          "end": "2019-08-24T14:15:22Z"
        }
      ],
      "capacity1": 0,
      "capacity2": 0,
      "operationDuration": 0,
      "customFields": {},
      "orderItems": [
        {
          "itemReferenceNumber": "string",
          "orderReferenceNumber": "string",
          "name": "string",
          "description": "string",
          "barcode": "string",
          "status": "CHECKED",
          "rejectReason": "string",
          "rejectComment": "string",
          "pricePerUnit": 0,
          "plannedQuantity": 0,
          "factQuantity": 0,
          "totalAmount": 0,
          "height": 0,
          "width": 0,
          "length": 0,
          "weight": 0,
          "volume": 0
        }
      ],
      "price": 10
    }
}
```


<a name="delete-an-order"></a>
## Delete an order

### Method
`DELETE`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/orders/{orderReference}`

### Request

### Path Parameters

### Responses

| Code | Description |
|------|-------------|
| `200` | - |
| `409` | - |

#### Body

Content Type: `application/json`

### Description
Warning

### Description
An integer warning code

### Description
Any additional details that the warning message may carry.

```json{
    "warnings": {
      "code": "string",
      "name": "string",
      "details": "string",
      "field": "string"
    }
}
```


<a name="get-widget-info-for-order-by-reference"></a>
## Get widget info for order by reference

### Method
`GET`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/orders/{reference}/widget`

### Description
Returns widget details of a particular order by it's reference

### Request

### Path Parameters

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

#### Body

Content Type: `application/json`

### Description
WidgetTrackingDetails

### Description
Object that contains an order tracking ID and URL from the tracking widget. Available in /orders only when expand parameter WIDGET is set.

### Description
Alphanumeric id for order tracking

```json{
    "data": {
      "trackingId": "string",
      "externalTrackingUri": "http://example.com"
    }
}
```


<a name="get-loading-state-of-an-order"></a>
## Get loading state of an order

### Method
`GET`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/orders/{orderReference}/loading`

### Description
Returns loading status of an order and individual loading statuses of order items.

### Description
Loading management addon should be enabled for the account.

### Description
If not then system will respond with 412 error code and Functionality not enabled error.

### Description
If order does not contain any items then system will respond with UNKNOWN status.

### Description
If order not yet sent to loading or loading process is not started yet then system will respond with NOT_LOADED status.

### Request

### Path Parameters

### Description
Order Reference

### Responses

| Code | Description |
|------|-------------|
| `200` | - |
| `404` | - |

#### Body

Content Type: `application/json`

### Description
OrderLoadingInfo

### Description
An object containing order loading status and individual loading statuses of the items in this order

### Description
Loading Status of Order or Run for Loading Management

### Description
Allowed values:

### Description
An object containing order item loading status and additional fields

```json{
    "data": {
      "orderReferenceNumber": "string",
      "orderLoadingStatus": "LOADED",
      "orderItemsLoading": [
        {
          "name": "string",
          "barcode": "string",
          "quantity": 0,
          "loadedQuantity": 0,
          "loadingStatus": "LOADED"
        }
      ]
    },
    "": "string"
}
```


<a name="get-vehicle-details"></a>
## Get vehicle details

### Method
`GET`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/vehicles/{reference}`

### Request

### Path Parameters

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

#### Body

Content Type: `application/json`
| `200` | - |

### Description
VehicleDetails

### Description
Called External ID in UI

### Description
Allowed values:

### Description
In the units of the account (mph or kmph).

### Description
Multiple of:

### Description
Multiple of:

### Description
In the units of the account (per mile or per km)

### Description
Multiple of:

### Description
Multiple of:

### Description
Multiple of:

### Description
Multiple of:

### Description
Multiple of:

### Description
In the units of the account (km or miles)

### Description
Multiple of:

```json{
    "data": {
      "referenceNumber": "string",
      "name": "string",
      "assignedDevice": "string",
      "trackingSource": "TOMTOM",
      "vehicleRequirementsReferences": [
        "string"
      ],
      "maxSpeed": 0,
      "drivingTimeCorrectionFactor": 1,
      "costPerDistance": 0,
      "activationCost": 0,
      "costPerOrder": 0,
      "capacity1": 0,
      "capacity2": 0,
      "runDistanceLimit": 0,
      "distributionCentreReference": "string",
      "distributionCentreName": "string",
      "assignedDriverReference": "string",
      "assignedDriverName": "string",
      "territoriesReferences": [
        "string"
      ],
      "comment": "string",
      "manufacturer": "string",
      "VIN": "string",
      "isStandDown": true,
      "isArchived": true,
      "color": "#FF00AA"
    }
}
```


<a name="update-an-existing-vehicle"></a>
## Update an existing vehicle

### Method
`PUT`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/vehicles/{reference}`

<a name="update-a-vehicle"></a>
## Update a vehicle

### Request

### Path Parameters

#### Body

Content Type: `application/json`

### Description
Called External ID in UI

### Description
Allowed values:

### Description
In the units of the account (mph or kmph).

### Description
Multiple of:

### Description
Multiple of:

### Description
In the units of the account (per mile or per km)

### Description
Multiple of:

### Description
Multiple of:

### Description
Multiple of:

### Description
Multiple of:

### Description
Multiple of:

### Description
In the units of the account (km or miles)

### Description
Multiple of:

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

### Description
Vehicle updated. Returns the data of the updated object.

#### Body

Content Type: `application/json`
| `200` | - |

### Description
VehicleDetails

### Description
Called External ID in UI

### Description
Allowed values:

### Description
In the units of the account (mph or kmph).

### Description
Multiple of:

### Description
Multiple of:

### Description
In the units of the account (per mile or per km)

### Description
Multiple of:

### Description
Multiple of:

### Description
Multiple of:

### Description
Multiple of:

### Description
Multiple of:

### Description
In the units of the account (km or miles)

### Description
Multiple of:

### Description
An integer warning code

### Description
Any additional details that the warning message may carry.

```json{
    "referenceNumber": "string",
    "name": "string",
    "assignedDevice": "string",
    "trackingSource": "TOMTOM",
    "vehicleRequirementsReferences": [
      "string"
    ],
    "maxSpeed": -3.402823669209385e+38,
    "drivingTimeCorrectionFactor": 1,
    "costPerDistance": -3.402823669209385e+38,
    "activationCost": -3.402823669209385e+38,
    "costPerOrder": -3.402823669209385e+38,
    "capacity1": -3.402823669209385e+38,
    "capacity2": -3.402823669209385e+38,
    "runDistanceLimit": -3.402823669209385e+38,
    "distributionCentreReference": "string",
    "assignedDriverReference": "string",
    "territoriesReferences": [
      "string"
    ],
    "comment": "string",
    "manufacturer": "string",
    "VIN": "string",
    "isStandDown": true,
    "isArchived": true,
    "color": "#FF00AA"
}
```


```json{
    "data": {
      "referenceNumber": "string",
      "name": "string",
      "assignedDevice": "string",
      "trackingSource": "TOMTOM",
      "vehicleRequirementsReferences": [
        "string"
      ],
      "maxSpeed": 0,
      "drivingTimeCorrectionFactor": 1,
      "costPerDistance": 0,
      "activationCost": 0,
      "costPerOrder": 0,
      "capacity1": 0,
      "capacity2": 0,
      "runDistanceLimit": 0,
      "distributionCentreReference": "string",
      "distributionCentreName": "string",
      "assignedDriverReference": "string",
      "assignedDriverName": "string",
      "territoriesReferences": [
        "string"
      ],
      "comment": "string",
      "manufacturer": "string",
      "VIN": "string",
      "isStandDown": true,
      "isArchived": true,
      "color": "#FF00AA"
    },
    "warnings": [
      {
        "code": "string",
        "name": "string",
        "details": "string",
        "field": "string"
      }
    ]
}
```


<a name="partially-update-a-vehicle"></a>
## Partially update a vehicle

### Method
`PATCH`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/vehicles/{reference}`

<a name="update-a-vehicle.-only-updates-specified-fields.-none-of-the-fields-are-mandatory."></a>
## Update a vehicle. Only updates specified fields. None of the fields are mandatory.

### Request

### Path Parameters

#### Body

Content Type: `application/json`

### Description
Called External ID in UI

### Description
Allowed values:

### Description
In the units of the account (mph or kmph).

### Description
Multiple of:

### Description
Multiple of:

### Description
In the units of the account (per mile or per km)

### Description
Multiple of:

### Description
Multiple of:

### Description
Multiple of:

### Description
Multiple of:

### Description
Multiple of:

### Description
In the units of the account (km or miles)

### Description
Multiple of:

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

### Description
Object successfully updated. Returns the data of the updated object and warnings if any.

#### Body

Content Type: `application/json`
| `200` | - |

### Description
VehicleDetails

### Description
Called External ID in UI

### Description
Allowed values:

### Description
In the units of the account (mph or kmph).

### Description
Multiple of:

### Description
Multiple of:

### Description
In the units of the account (per mile or per km)

### Description
Multiple of:

### Description
Multiple of:

### Description
Multiple of:

### Description
Multiple of:

### Description
Multiple of:

### Description
In the units of the account (km or miles)

### Description
Multiple of:

### Description
An integer warning code

### Description
Any additional details that the warning message may carry.

```json{
    "referenceNumber": "string",
    "name": "string",
    "assignedDevice": "string",
    "trackingSource": "TOMTOM",
    "vehicleRequirementsReferences": [
      "string"
    ],
    "maxSpeed": -3.402823669209385e+38,
    "drivingTimeCorrectionFactor": 1,
    "costPerDistance": -3.402823669209385e+38,
    "activationCost": -3.402823669209385e+38,
    "costPerOrder": -3.402823669209385e+38,
    "capacity1": -3.402823669209385e+38,
    "capacity2": -3.402823669209385e+38,
    "runDistanceLimit": -3.402823669209385e+38,
    "distributionCentreReference": "string",
    "assignedDriverReference": "string",
    "territoriesReferences": [
      "string"
    ],
    "comment": "string",
    "manufacturer": "string",
    "VIN": "string",
    "isStandDown": true,
    "isArchived": true,
    "color": "#FF00AA"
}
```


```json{
    "data": {
      "referenceNumber": "string",
      "name": "string",
      "assignedDevice": "string",
      "trackingSource": "TOMTOM",
      "vehicleRequirementsReferences": [
        "string"
      ],
      "maxSpeed": 0,
      "drivingTimeCorrectionFactor": 1,
      "costPerDistance": 0,
      "activationCost": 0,
      "costPerOrder": 0,
      "capacity1": 0,
      "capacity2": 0,
      "runDistanceLimit": 0,
      "distributionCentreReference": "string",
      "distributionCentreName": "string",
      "assignedDriverReference": "string",
      "assignedDriverName": "string",
      "territoriesReferences": [
        "string"
      ],
      "comment": "string",
      "manufacturer": "string",
      "VIN": "string",
      "isStandDown": true,
      "isArchived": true,
      "color": "#FF00AA"
    },
    "warnings": [
      {
        "code": "string",
        "name": "string",
        "details": "string",
        "field": "string"
      }
    ]
}
```


<a name="delete-a-vehicle"></a>
## Delete a vehicle

### Method
`DELETE`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/vehicles/{reference}`

<a name="delete-a-vehicle"></a>
## Delete a vehicle

### Request

### Path Parameters

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

#### Body

Content Type: `application/json`
| `200` | - |

### Description
Warning

### Description
An integer warning code

### Description
Any additional details that the warning message may carry.

```json{
    "warnings": {
      "code": "string",
      "name": "string",
      "details": "string",
      "field": "string"
    }
}
```


<a name="get-a-list-of-vehicles"></a>
## Get a list of vehicles

### Method
`GET`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/vehicles`

<a name="get-a-list-of-vehicles"></a>
## Get a list of vehicles

### Request

### Query Parameters

### Description
How many records to skip. 0 by default

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

### Description
Returns a list of vehicles. If no vehicles were found, an empty list is returned.

#### Body

Content Type: `application/json`
| `200` | - |

### Description
Called External ID in UI

### Description
Multiple of:

### Description
Multiple of:

### Description
How many records were skipped (based on the GET parameter offset)

### Description
PagingLinks

### Description
Relative URL of the previous page of results. Use this to navigate back to the previous page.Show all...

### Description
Relative URL of the next page of results. Use this to navigate to the next page.Show all...

```json{
    "data": [
      {
        "referenceNumber": "string",
        "name": "string",
        "capacity1": 0,
        "capacity2": 0,
        "distributionCentreReference": "string",
        "distributionCentreName": "string",
        "assignedDriverReference": "string",
        "assignedDriverName": "string"
      }
    ],
    "offset": 0,
    "_links": {
      "prev": "/orders?offset=20",
      "next": "/orders?offset=40"
    }
}
```


<a name="create-a-vehicle"></a>
## Create a vehicle

### Method
`POST`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/vehicles`

<a name="create-a-vehicle"></a>
## Create a vehicle

### Request

#### Body

Content Type: `application/json`

### Description
Called External ID in UI

### Description
Allowed values:

### Description
In the units of the account (mph or kmph).

### Description
Multiple of:

### Description
Multiple of:

### Description
In the units of the account (per mile or per km)

### Description
Multiple of:

### Description
Multiple of:

### Description
Multiple of:

### Description
Multiple of:

### Description
Multiple of:

### Description
In the units of the account (km or miles)

### Description
Multiple of:

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

#### Body

Content Type: `application/json`
| `200` | - |

### Description
An integer warning code

### Description
Any additional details that the warning message may carry.

### Description
VehicleDetails

### Description
Called External ID in UI

### Description
Allowed values:

### Description
In the units of the account (mph or kmph).

### Description
Multiple of:

### Description
Multiple of:

### Description
In the units of the account (per mile or per km)

### Description
Multiple of:

### Description
Multiple of:

### Description
Multiple of:

### Description
Multiple of:

### Description
Multiple of:

### Description
In the units of the account (km or miles)

### Description
Multiple of:

```json{
    "referenceNumber": "string",
    "name": "string",
    "assignedDevice": "string",
    "trackingSource": "TOMTOM",
    "vehicleRequirementsReferences": [
      "string"
    ],
    "maxSpeed": -3.402823669209385e+38,
    "drivingTimeCorrectionFactor": 1,
    "costPerDistance": -3.402823669209385e+38,
    "activationCost": -3.402823669209385e+38,
    "costPerOrder": -3.402823669209385e+38,
    "capacity1": -3.402823669209385e+38,
    "capacity2": -3.402823669209385e+38,
    "runDistanceLimit": -3.402823669209385e+38,
    "distributionCentreReference": "string",
    "assignedDriverReference": "string",
    "territoriesReferences": [
      "string"
    ],
    "comment": "string",
    "manufacturer": "string",
    "VIN": "string",
    "isStandDown": true,
    "isArchived": true,
    "color": "#FF00AA"
}
```


```json{
    "warnings": [
      {
        "code": "string",
        "name": "string",
        "details": "string",
        "field": "string"
      }
    ],
    "data": {
      "referenceNumber": "string",
      "name": "string",
      "assignedDevice": "string",
      "trackingSource": "TOMTOM",
      "vehicleRequirementsReferences": [
        "string"
      ],
      "maxSpeed": 0,
      "drivingTimeCorrectionFactor": 1,
      "costPerDistance": 0,
      "activationCost": 0,
      "costPerOrder": 0,
      "capacity1": 0,
      "capacity2": 0,
      "runDistanceLimit": 0,
      "distributionCentreReference": "string",
      "distributionCentreName": "string",
      "assignedDriverReference": "string",
      "assignedDriverName": "string",
      "territoriesReferences": [
        "string"
      ],
      "comment": "string",
      "manufacturer": "string",
      "VIN": "string",
      "isStandDown": true,
      "isArchived": true,
      "color": "#FF00AA"
    }
}
```


<a name="get-schedule-for-a-distribution-centre"></a>
## Get schedule for a distribution centre

### Method
`GET`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/schedules/dc/{dcReference}/{shiftDate}`

<a name="get-allocated-schedule"></a>
## Get allocated schedule

### Request

### Path Parameters

### Query Parameters

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

#### Body

Content Type: `application/json`
| `200` | An object representing a schedule, which is a collection of driver shifts |

### Description
An object representing one run.

```json{
    "driverShifts": [
      {
        "driverName": "string",
        "driverReference": "string",
        "vehicleName": "string",
        "vehicleReference": "string",
        "shiftDate": "2019-08-24",
        "shiftStartTime": "2019-08-24T14:15:22Z",
        "shiftEndTime": "2019-08-24T14:15:22Z",
        "runs": [
          {
            "plannedLoadingStartTime": "2019-08-24T14:15:22Z",
            "plannedDepartureTime": "2019-08-24T14:15:22Z",
            "plannedReturnStartTime": "2019-08-24T14:15:22Z",
            "plannedCompletionTime": "2019-08-24T14:15:22Z",
            "totalOrders": 0,
            "totalDuration": 0,
            "totalDistance": 0,
            "totalCapacity1": 0,
            "totalCapacity2": 0,
            "allocations": [
              {
                "orderReference": "string",
                "customerLocationName": "string",
                "customerLocationAddress": "string",
                "latitude": 0,
                "longitude": 0,
                "plannedDrivingStartTime": "2019-08-24T14:15:22Z",
                "plannedArrivalTime": "2019-08-24T14:15:22Z",
                "plannedCompletionTime": "2019-08-24T14:15:22Z",
                "status": "string",
                "sequenceNumber": 0,
                "task": "DELIVERY"
              }
            ],
            "isLocked": true,
            "reference": "4381e86f099f4bce922c2485c2398aa7",
            "runNumber": 0,
            "totalDeliveries": 0,
            "totalCollections": 0
          }
        ],
        "totalWorkingTime": 0,
        "totalDrivingTime": 0,
        "totalDistance": 0
      }
    ]
}
```


### Description
Unallocate all scheduled orders for DC

### Method
`DELETE`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/schedules/dc/{dcReference}/{shiftDate}`

### Description
Unallocate all scheduled orders from DC for shiftDate. Async operation. To track the progress please read 'Working with ASYNC actions'

### Request

### Path Parameters

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

### Description
Started to unallocate orders

#### Body

Content Type: `application/json`

```json{
    "taskReference": "string",
    "operationReference": "string"
}
```


### Description
Import schedules for a distribution centre

### Method
`POST`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/schedules/dc/{dcReference}/{shiftDate}`

### Description
Import schedules for a Distribution centre on Shift Date Import clears all previous orders on resource and plans the orders according to the sent sequence Either vehicle reference or driver reference can be used for indetifying a resource for schedule

### Description
To track the progress please read 'Working with ASYNC actions'

### Request

### Path Parameters

#### Body

Content Type: `application/json`

### Description
Array of schedules to import

### Description
If this setting is true - when an order is already allocated to an existing run - it will be automatically unallocated and the run will be re-sequenced

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

### Description
Started clearing the schedule and plan orders to vehicles

#### Body

Content Type: `application/json`
| `200` | taskReference |

```json{
    "schedules": [
      {
        "driverReference": "string",
        "vehicleReference": "string",
        "orderReferences": [
          "string"
        ],
        "resequence": false
      }
    ],
    "resequenceModifiedRuns": false
}
```


```json{
    "taskReference": "string",
    "operationReference": "string"
}
```


<a name="get-schedule-for-a-vehicle"></a>
## Get schedule for a vehicle

### Method
`GET`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/schedules/vehicle/{vehicleReference}/{shiftDate}`

### Request

### Path Parameters

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

#### Body

Content Type: `application/json`
| `200` | An object representing a schedule, which is a collection of driver shifts |

### Description
An object representing one run.

```json{
    "driverShifts": [
      {
        "driverName": "string",
        "driverReference": "string",
        "vehicleName": "string",
        "vehicleReference": "string",
        "shiftDate": "2019-08-24",
        "shiftStartTime": "2019-08-24T14:15:22Z",
        "shiftEndTime": "2019-08-24T14:15:22Z",
        "runs": [
          {
            "plannedLoadingStartTime": "2019-08-24T14:15:22Z",
            "plannedDepartureTime": "2019-08-24T14:15:22Z",
            "plannedReturnStartTime": "2019-08-24T14:15:22Z",
            "plannedCompletionTime": "2019-08-24T14:15:22Z",
            "totalOrders": 0,
            "totalDuration": 0,
            "totalDistance": 0,
            "totalCapacity1": 0,
            "totalCapacity2": 0,
            "allocations": [
              {
                "orderReference": "string",
                "customerLocationName": "string",
                "customerLocationAddress": "string",
                "latitude": 0,
                "longitude": 0,
                "plannedDrivingStartTime": "2019-08-24T14:15:22Z",
                "plannedArrivalTime": "2019-08-24T14:15:22Z",
                "plannedCompletionTime": "2019-08-24T14:15:22Z",
                "status": "string",
                "sequenceNumber": 0,
                "task": "DELIVERY"
              }
            ],
            "isLocked": true,
            "reference": "4381e86f099f4bce922c2485c2398aa7",
            "runNumber": 0,
            "totalDeliveries": 0,
            "totalCollections": 0
          }
        ],
        "totalWorkingTime": 0,
        "totalDrivingTime": 0,
        "totalDistance": 0
      }
    ]
}
```


<a name="get-schedule-for-a-driver"></a>
## Get schedule for a driver

### Method
`GET`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/schedules/driver/{driverReference}/{shiftDate}`

### Request

### Path Parameters

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

#### Body

Content Type: `application/json`
| `200` | An object representing a schedule, which is a collection of driver shifts |

### Description
An object representing one run.

```json{
    "driverShifts": [
      {
        "driverName": "string",
        "driverReference": "string",
        "vehicleName": "string",
        "vehicleReference": "string",
        "shiftDate": "2019-08-24",
        "shiftStartTime": "2019-08-24T14:15:22Z",
        "shiftEndTime": "2019-08-24T14:15:22Z",
        "runs": [
          {
            "plannedLoadingStartTime": "2019-08-24T14:15:22Z",
            "plannedDepartureTime": "2019-08-24T14:15:22Z",
            "plannedReturnStartTime": "2019-08-24T14:15:22Z",
            "plannedCompletionTime": "2019-08-24T14:15:22Z",
            "totalOrders": 0,
            "totalDuration": 0,
            "totalDistance": 0,
            "totalCapacity1": 0,
            "totalCapacity2": 0,
            "allocations": [
              {
                "orderReference": "string",
                "customerLocationName": "string",
                "customerLocationAddress": "string",
                "latitude": 0,
                "longitude": 0,
                "plannedDrivingStartTime": "2019-08-24T14:15:22Z",
                "plannedArrivalTime": "2019-08-24T14:15:22Z",
                "plannedCompletionTime": "2019-08-24T14:15:22Z",
                "status": "string",
                "sequenceNumber": 0,
                "task": "DELIVERY"
              }
            ],
            "isLocked": true,
            "reference": "4381e86f099f4bce922c2485c2398aa7",
            "runNumber": 0,
            "totalDeliveries": 0,
            "totalCollections": 0
          }
        ],
        "totalWorkingTime": 0,
        "totalDrivingTime": 0,
        "totalDistance": 0
      }
    ]
}
```


### Description
Unallocate order

### Method
`DELETE`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/schedules/order/{orderReference}`

### Description
Unallocate scheduled order. Async operation. To track the progress please read 'Working with ASYNC actions'

### Request

### Path Parameters

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

### Description
Started to unallocate order

#### Body

Content Type: `application/json`

```json{
    "taskReference": "string",
    "operationReference": "string"
}
```


### Description
Unallocate run

### Method
`DELETE`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/schedules/run/{runReference}`

### Description
Unallocate scheduled run. Async operation. To track the progress please read 'Working with ASYNC actions'

### Request

### Path Parameters

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

### Description
Started to unallocate run

#### Body

Content Type: `application/json`

```json{
    "taskReference": "string",
    "operationReference": "string"
}
```


<a name="create-a-subscription"></a>
## Create a subscription

### Method
`POST`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/subscriptions`

<a name="create-a-webhook-subscription-for-specified-event-type."></a>
## Create a Webhook subscription for specified event type.

### Description
Note that duplicate subscriptions cannot be created. Note that there cannot be more than 5 subscriptions to specific event type.

### Request

#### Body

Content Type: `application/json`

### Description
Input body to create subscription.

### Description
Subscriptions API details.

### Description
Input object to create Webhook Subscription for a specified event.

### Description
Supported event types for subscriptions

### Description
Allowed values:

### URL
`https://server.domain.com`

### Description
Optional filter for this subscription. Usable only if event type is ORDER_STATUS_UPDATED.Show all...

### Description
Allowed values:

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

#### Body

Content Type: `application/json`
| `200` | - |

### Description
Subscription

### Description
Supported event types for subscriptions

### Description
Allowed values:

### URL
`https://server.domain.com`

```json{
    "event": "ORDER_STATUS_UPDATED",
    "url": "https://server.domain.com",
    "secret": "some-secret",
    "filterStatus": "UNALLOCATED"
}
```


```json{
    "data": {
      "reference": "string",
      "event": "ORDER_STATUS_UPDATED",
      "url": "https://server.domain.com"
    }
}
```


<a name="get-a-list-of-subscriptions"></a>
## Get a list of subscriptions

### Method
`GET`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/subscriptions`

### Request

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

#### Body

Content Type: `application/json`

### Description
Supported event types for subscriptions

### Description
Allowed values:

### URL
`https://server.domain.com`

```json{
    "data": [
      {
        "reference": "string",
        "event": "ORDER_STATUS_UPDATED",
        "url": "https://server.domain.com"
      }
    ]
}
```


<a name="get-a-subscription"></a>
## Get a subscription

### Method
`GET`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/subscriptions/{reference}`

### Description
Return subscription by reference if it exists

### Request

### Path Parameters

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

#### Body

Content Type: `application/json`

### Description
Subscription

### Description
Supported event types for subscriptions

### Description
Allowed values:

### URL
`https://server.domain.com`

```json{
    "data": {
      "reference": "string",
      "event": "ORDER_STATUS_UPDATED",
      "url": "https://server.domain.com"
    }
}
```


<a name="delete-a-subscription"></a>
## Delete a subscription

### Method
`DELETE`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/subscriptions/{reference}`

<a name="deletes-a-subscription-by-reference-if-it-exists"></a>
## Deletes a subscription by reference if it exists

### Request

### Path Parameters

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

### Method
`PATCH`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/subscriptions/{reference}`

### Description
Patch subscription by reference

### Request

### Path Parameters

#### Body

Content Type: `application/json`

### Description
Allowed values:

### Description
Some Name

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

#### Body

Content Type: `application/json`
| `200` | - |

### Description
Subscription

### Description
Supported event types for subscriptions

### Description
Allowed values:

### URL
`https://server.domain.com`

```json{
    "data": {
      "reference": "string",
      "event": "ORDER_STATUS_UPDATED",
      "url": "https://server.domain.com"
    }
}
```


<a name="get-subscription-communication-log"></a>
## Get subscription communication log

### Method
`GET`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/subscriptions/{reference}/log`

<a name="get-all-communications-logs-regarding-your-subscription"></a>
## Get all communications logs regarding your subscription

### Request

### Path Parameters

### Description
Subscription reference

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

#### Body

Content Type: `application/json`
| `200` | - |

### Description
Your server response code on event
| `200` | event |

### Description
Supported event types for subscriptions

### Description
Allowed values:

### Description
Exact timestamp when request for your server was sent

### Description
Data package that was sent to your server

```json{
    "data": [
      {
        "responseCode": 200,
        "event": "ORDER_STATUS_UPDATED",
        "dateTime": "2019-08-24T14:15:22Z",
        "payload": "string",
        "response": "string"
      }
    ]
}
```


### Description
Lock a run

### Method
`POST`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/runs/{runReference}/lock`

### Description
Lock a particular run by it's reference number.

### Request

### Path Parameters

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

### Method
`POST`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/runs/{runReference}/unlock`

### Description
Unlock a run by it's reference number.

### Request

### Path Parameters

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

### Method
`POST`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/runs/{reference}/send`

### Request

### Path Parameters

### Description
Run reference

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

### Description
Run is successfuly sent or already in sent state

<a name="get-loading-info-for-run"></a>
## Get loading info for run

### Method
`GET`

### URL
`https://yourmaxoptraaccount.maxoptra.com/api/v6/runs/{runReference}/loading`

### Description
Returns loading status of a run and individual loading statuses of orders in the run.

### Description
Loading management addon should be enabled for the account. If not then system will respond with 412 error code and Addon not enabled error.

### Description
If run does not contain any orders with order items then system will still respond with code 200 and NOT_LOADED status.

### Description
If order not yet sent to loading or loading process is not started yet then system will respond with NOT_LOADED status.

### Request

### Path Parameters

### Description
Run Reference

### Responses

| Code | Description |
|------|-------------|
| `200` | - |

#### Body

Content Type: `application/json`
| `200` | - |

### Description
RunLoadingInfo

### Description
An object containing run loading status and individual loading statuses of the orders in this run

### Description
Loading Status of Order or Run for Loading Management

### Description
Allowed values:

```json{
    "data": {
      "runReference": "string",
      "runLoadingStatus": "LOADED",
      "ordersLoading": [
        {
          "orderReference": "string",
          "orderLoadingStatus": "LOADED"
        }
      ]
    }
}
```

