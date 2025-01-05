# Maxoptra API Models Documentation

Generated on: 2025-01-04 15:47:00.051302

This documentation describes the data models used in the Maxoptra API.

## Table of Contents

- [ADDRESS](#address)

- [Allocation](#allocation)

- [Attachment](#attachment)

- [COLLECTION](#collection)

- [DCSummary](#dcsummary)

- [DELIVERY](#delivery)

- [DriverSummary](#driversummary)

- [ErrorResponse](#errorresponse)

- [GeoPosition](#geoposition)

- [HIGH](#high)

- [JsonPatchCommand](#jsonpatchcommand)

- [LAST](#last)

- [NO](#no)

- [OrderExecutionInfo](#orderexecutioninfo)

- [OrderItem](#orderitem)

- [OrderItemsInfo](#orderitemsinfo)

- [OrderStatus](#orderstatus)

- [Run](#run)

- [Schedule](#schedule)

- [ScheduleImport](#scheduleimport)

- [ScheduleImportRecord](#scheduleimportrecord)

- [Shift](#shift)

- [VehicleDetails](#vehicledetails)

- [WidgetTrackingDetails](#widgettrackingdetails)


---


<a name="address"></a>
## ADDRESS

Default:


<a name="allocation"></a>
## Allocation

An object that represents an order in a schedule.

### Schema

| Property | Type | Description | Constraints |
|----------|------|-------------|-------------|
| `Type` | `of` | executed task | Allowed values: 
Default:  |
| `Which` | `sequence` | number this order has in the run task string | None |



<a name="attachment"></a>
## Attachment

An object representing an photo attachment to an order


<a name="collection"></a>
## COLLECTION

Default:


<a name="dcsummary"></a>
## DCSummary

### Schema

| Property | Type | Description | Constraints |
|----------|------|-------------|-------------|
| `The` | `address` | of the distribution centre. | None |



<a name="delivery"></a>
## DELIVERY

Default:


<a name="driversummary"></a>
## DriverSummary

### Schema

| Property | Type | Description | Constraints |
|----------|------|-------------|-------------|
| `A` | `model` | that represents details of an order. Can be used to read, create and modify orders | None |
| `To` | `streamline` | the planning process, Pickup and Delivery orders can be associated through a unique consignmentReference, establishing a 1:1 relationship between a delivery and collection task. distributionCentreReference string distributionCentreName string read-only task string | Min: 0 characters
Max: 255 characters
Allowed values:  |



<a name="errorresponse"></a>
## ErrorResponse

### Schema

| Property | Type | Description | Constraints |
|----------|------|-------------|-------------|
| `A` | `text` | description of a warning. Please do not use it in your client's code as the name can change. User warning codes instead - they will not change. details string | None |
| `An` | `integer` | warning code name string | None |
| `Any` | `additional` | details that the warning message may carry. field string (optional) The name of the data field the warning is related to. | None |
| `The` | `name` | of the error. The names of errors may change so please use the error code in your integration's code. details string | None |



<a name="geoposition"></a>
## GeoPosition

An object that describes a geographical position with latitude and longitude

### Schema

| Property | Type | Description | Constraints |
|----------|------|-------------|-------------|
| `A` | `model` | to represent an error that may be included a response to indicate a reason why a request cannot be processed or failed. | None |
| `An` | `integer` | warning code name string | None |
| `Any` | `additional` | relevant details, human-readable. field string (optional) The name of the field the error relates to. | None |
| `Spring` | `fountains` | Inc. address string | Example:
```json
null
primaryTelephone
string
secondaryTelephone
string
email
string
website
string
settings
object
allowSMS
boolean
allowEmail
boolean
fixedTimePerAddress
number
fixedTimePerOrder
number
timePerCapacityDelivery
number
preferredDriverReferences
array[string]
vehicleRequirementsReferences
array[string]
availability
object
default
``` |
| `The` | `name` | of the error. The names of errors may change so please use the error code in your integration's code. details string | None |



<a name="high"></a>
## HIGH

Default:


<a name="jsonpatchcommand"></a>
## JsonPatchCommand

### Schema

| Property | Type | Description | Constraints |
|----------|------|-------------|-------------|
| `Some` | `Name` |  | None |



<a name="last"></a>
## LAST

Default:

### Schema

| Property | Type | Description | Constraints |
|----------|------|-------------|-------------|
| `A` | `lightweight` | object describing basic order details. Used in list methods. | None |
| `Called` | `External` | ID in UI name string | None |
| `The` | `default` | name of the vehicle capacity1 number<float> 0.001 capacity2 number<float> 0.001 distributionCentreReference string distributionCentreName string read-only assignedDriverReference string assignedDriverName string read-only | Multiple of: 
Multiple of:  |
| `Used` | `to` | group P&D orders in pairs. If set - assumes consignmentLinkType = "PickupAndDeliver". distributionCentreReference string distributionCentreName string read-only task string | Allowed values:  |



<a name="no"></a>
## NO

Default:

### Schema

| Property | Type | Description | Constraints |
|----------|------|-------------|-------------|
| `Local` | `time` | in ISO 8601 format | None |
| `SAME_DAY` | `for` | same day, DAY_PLUS_1 next day, etc. SAME_DAY DAY_PLUS_1 DAY_PLUS_2 DAY_PLUS_3 DAY_PLUS_4 SAME_DAY endTime string<time> | Allowed values: 
Default:  |
| `Set` | `to` | true to make the driver start exactly at start time, no later. endDay string | None |



<a name="orderexecutioninfo"></a>
## OrderExecutionInfo

Information about how the order is executed. Includes the order's allocation information, status, real-time ETA, actual and reported times


<a name="orderitem"></a>
## OrderItem

An object that represents an order item.


<a name="orderitemsinfo"></a>
## OrderItemsInfo

An object containing items information for a particular order.

### Schema

| Property | Type | Description | Constraints |
|----------|------|-------------|-------------|
| `A` | `model` | containing information that can be used to display the current position of the order. | None |
| `An` | `object` | that describes a geographical position with latitude and longitude latitude number longitude number status string | None |
| `If` | `the` | position is not available (e.g. because of the order status), currentPosition should be null. | None |



<a name="orderstatus"></a>
## OrderStatus


<a name="run"></a>
## Run

An object representing one run.

### Schema

| Property | Type | Description | Constraints |
|----------|------|-------------|-------------|
| `A` | `reference` | of this particular run for further use in API. We recommend that you do not store the reference long-term as some planning actions can lead to a different run with a different reference forming in place of the old one. | Example:
```json
4381e86f099f4bce922c2485c2398aa7
runNumber
integer
``` |
| `An` | `object` | that represents an order in a schedule. orderReference string customerLocationName string customerLocationAddress string latitude number longitude number plannedDrivingStartTime string<date-time> plannedArrivalTime string<date-time> plannedCompletionTime string<date-time> status string sequenceNumber integer | None |
| `Sequence` | `number` | of this run in Schedule totalDeliveries integer read-only | None |
| `The` | `total` | used capacity for capacity 2 allocations array[Allocation] | None |
| `Total` | `collections` | in the run | Min: 0 |
| `Type` | `of` | executed task | Allowed values: 
Default: 
Example:
```json
isLocked
boolean
reference
string
``` |
| `Which` | `sequence` | number this order has in the run task string | None |
| `the` | `total` | used capacity for capacity 1 totalCapacity2 number | None |
| `total` | `distance` | either in km or miles depending on account settings totalCapacity1 number | None |



<a name="schedule"></a>
## Schedule

An object representing a schedule, which is a collection of driver shifts

### Schema

| Property | Type | Description | Constraints |
|----------|------|-------------|-------------|
| `An` | `object` | representing one run. totalWorkingTime integer | None |
| `The` | `total` | distance driven in the shift. In kilometers or miles, depending on the account settings. | None |



<a name="scheduleimport"></a>
## ScheduleImport

### Schema

| Property | Type | Description | Constraints |
|----------|------|-------------|-------------|
| `Array` | `of` | schedules to import driverReference | None |
| `If` | `this` | setting is true - when an order is already allocated to an existing run - it will be automatically unallocated and the run will be re-sequenced false | Default:  |
| `string` | `or` | null orderReferences array[string] required resequence boolean false resequenceModifiedRuns boolean | Default:  |



<a name="scheduleimportrecord"></a>
## ScheduleImportRecord

Already planned and sequenced schedule for driver or vehicle Either driver reference or vehicle reference is required

### Schema

| Property | Type | Description | Constraints |
|----------|------|-------------|-------------|
| `string` | `or` | null orderReferences array[string] required resequence boolean false | Default:  |



<a name="shift"></a>
## Shift

An object representing a driver shift.

### Schema

| Property | Type | Description | Constraints |
|----------|------|-------------|-------------|
| `A` | `reference` | of this particular run for further use in API. We recommend that you do not store the reference long-term as some planning actions can lead to a different run with a different reference forming in place of the old one. | Example:
```json
4381e86f099f4bce922c2485c2398aa7
runNumber
integer
``` |
| `An` | `object` | that represents an order in a schedule. isLocked boolean reference string | None |
| `Sequence` | `number` | of this run in Schedule totalDeliveries integer read-only | None |
| `The` | `total` | distance driven in the shift. In kilometers or miles, depending on the account settings. | None |
| `Total` | `collections` | in the run totalWorkingTime integer | Min: 0 |
| `the` | `total` | used capacity for capacity 1 totalCapacity2 number | None |
| `total` | `distance` | either in km or miles depending on account settings totalCapacity1 number | None |



<a name="vehicledetails"></a>
## VehicleDetails

### Schema

| Property | Type | Description | Constraints |
|----------|------|-------------|-------------|
| `A` | `list` | of territory references startOfDayLocation string | Allowed values:  |
| `Called` | `External` | ID in UI name string required | None |
| `In` | `the` | units of the account (km or miles) 0.01 distributionCentreReference string required distributionCentreName string read-only assignedDriverReference string assignedDriverName string read-only territoriesReferences array[string] comment string manufacturer string string isStandDown boolean isArchived boolean color string | Multiple of:  |
| `The` | `color` | in RGB HEX format with a leading "#" | Min: 7 characters
Max: 7 characters
Example:
```json
#FF00AA
``` |



<a name="widgettrackingdetails"></a>
## WidgetTrackingDetails

Object that contains an order tracking ID and URL from the tracking widget. Available in /orders only when expand parameter WIDGET is set.

### Schema

| Property | Type | Description | Constraints |
|----------|------|-------------|-------------|
| `Relative` | `URL` | of the next page of results. Use this to navigate to the next page.Show all... | None |

