
# Create Payment Request

Describes a request to create a payment using
[CreatePayment](../../doc/apis/payments.md#create-payment).

## Structure

`CreatePaymentRequest`

## Fields

| Name | Type | Tags | Description | Getter | Setter |
|  --- | --- | --- | --- | --- | --- |
| `sourceId` | `string` | Required | The ID for the source of funds for this payment.<br>This could be a payment token generated by the Web Payments SDK for any of its<br>[supported methods](https://developer.squareup.com/docs/web-payments/overview#explore-payment-methods),<br>including cards, bank transfers, Afterpay or Cash App Pay. If recording a payment<br>that the seller received outside of Square, specify either "CASH" or "EXTERNAL".<br>For more information, see<br>[Take Payments](https://developer.squareup.com/docs/payments-api/take-payments).<br>**Constraints**: *Minimum Length*: `1` | getSourceId(): string | setSourceId(string sourceId): void |
| `idempotencyKey` | `string` | Required | A unique string that identifies this `CreatePayment` request. Keys can be any valid string<br>but must be unique for every `CreatePayment` request.<br><br>Note: The number of allowed characters might be less than the stated maximum, if multi-byte<br>characters are used.<br><br>For more information, see [Idempotency](https://developer.squareup.com/docs/working-with-apis/idempotency).<br>**Constraints**: *Minimum Length*: `1`, *Maximum Length*: `45` | getIdempotencyKey(): string | setIdempotencyKey(string idempotencyKey): void |
| `amountMoney` | [`?Money`](../../doc/models/money.md) | Optional | Represents an amount of money. `Money` fields can be signed or unsigned.<br>Fields that do not explicitly define whether they are signed or unsigned are<br>considered unsigned and can only hold positive amounts. For signed fields, the<br>sign of the value indicates the purpose of the money transfer. See<br>[Working with Monetary Amounts](https://developer.squareup.com/docs/build-basics/working-with-monetary-amounts)<br>for more information. | getAmountMoney(): ?Money | setAmountMoney(?Money amountMoney): void |
| `tipMoney` | [`?Money`](../../doc/models/money.md) | Optional | Represents an amount of money. `Money` fields can be signed or unsigned.<br>Fields that do not explicitly define whether they are signed or unsigned are<br>considered unsigned and can only hold positive amounts. For signed fields, the<br>sign of the value indicates the purpose of the money transfer. See<br>[Working with Monetary Amounts](https://developer.squareup.com/docs/build-basics/working-with-monetary-amounts)<br>for more information. | getTipMoney(): ?Money | setTipMoney(?Money tipMoney): void |
| `appFeeMoney` | [`?Money`](../../doc/models/money.md) | Optional | Represents an amount of money. `Money` fields can be signed or unsigned.<br>Fields that do not explicitly define whether they are signed or unsigned are<br>considered unsigned and can only hold positive amounts. For signed fields, the<br>sign of the value indicates the purpose of the money transfer. See<br>[Working with Monetary Amounts](https://developer.squareup.com/docs/build-basics/working-with-monetary-amounts)<br>for more information. | getAppFeeMoney(): ?Money | setAppFeeMoney(?Money appFeeMoney): void |
| `delayDuration` | `?string` | Optional | The duration of time after the payment's creation when Square automatically<br>either completes or cancels the payment depending on the `delay_action` field value.<br>For more information, see<br>[Time threshold](https://developer.squareup.com/docs/payments-api/take-payments/card-payments/delayed-capture#time-threshold).<br><br>This parameter should be specified as a time duration, in RFC 3339 format.<br><br>Note: This feature is only supported for card payments. This parameter can only be set for a delayed<br>capture payment (`autocomplete=false`).<br><br>Default:<br><br>- Card-present payments: "PT36H" (36 hours) from the creation time.<br>- Card-not-present payments: "P7D" (7 days) from the creation time. | getDelayDuration(): ?string | setDelayDuration(?string delayDuration): void |
| `delayAction` | `?string` | Optional | The action to be applied to the payment when the `delay_duration` has elapsed. The action must be<br>CANCEL or COMPLETE. For more information, see<br>[Time Threshold](https://developer.squareup.com/docs/payments-api/take-payments/card-payments/delayed-capture#time-threshold).<br><br>Default: CANCEL | getDelayAction(): ?string | setDelayAction(?string delayAction): void |
| `autocomplete` | `?bool` | Optional | If set to `true`, this payment will be completed when possible. If<br>set to `false`, this payment is held in an approved state until either<br>explicitly completed (captured) or canceled (voided). For more information, see<br>[Delayed capture](https://developer.squareup.com/docs/payments-api/take-payments/card-payments#delayed-capture-of-a-card-payment).<br><br>Default: true | getAutocomplete(): ?bool | setAutocomplete(?bool autocomplete): void |
| `orderId` | `?string` | Optional | Associates a previously created order with this payment. | getOrderId(): ?string | setOrderId(?string orderId): void |
| `customerId` | `?string` | Optional | The [Customer](entity:Customer) ID of the customer associated with the payment.<br><br>This is required if the `source_id` refers to a card on file created using the Cards API. | getCustomerId(): ?string | setCustomerId(?string customerId): void |
| `locationId` | `?string` | Optional | The location ID to associate with the payment. If not specified, the [main location](https://developer.squareup.com/docs/locations-api#about-the-main-location) is<br>used. | getLocationId(): ?string | setLocationId(?string locationId): void |
| `teamMemberId` | `?string` | Optional | An optional [TeamMember](entity:TeamMember) ID to associate with<br>this payment. | getTeamMemberId(): ?string | setTeamMemberId(?string teamMemberId): void |
| `referenceId` | `?string` | Optional | A user-defined ID to associate with the payment.<br><br>You can use this field to associate the payment to an entity in an external system<br>(for example, you might specify an order ID that is generated by a third-party shopping cart).<br>**Constraints**: *Maximum Length*: `40` | getReferenceId(): ?string | setReferenceId(?string referenceId): void |
| `verificationToken` | `?string` | Optional | An identifying token generated by [payments.verifyBuyer()](https://developer.squareup.com/reference/sdks/web/payments/objects/Payments#Payments.verifyBuyer).<br>Verification tokens encapsulate customer device information and 3-D Secure<br>challenge results to indicate that Square has verified the buyer identity.<br><br>For more information, see [SCA Overview](https://developer.squareup.com/docs/sca-overview). | getVerificationToken(): ?string | setVerificationToken(?string verificationToken): void |
| `acceptPartialAuthorization` | `?bool` | Optional | If set to `true` and charging a Square Gift Card, a payment might be returned with<br>`amount_money` equal to less than what was requested. For example, a request for $20 when charging<br>a Square Gift Card with a balance of $5 results in an APPROVED payment of $5. You might choose<br>to prompt the buyer for an additional payment to cover the remainder or cancel the Gift Card<br>payment. This field cannot be `true` when `autocomplete = true`.<br><br>For more information, see<br>[Partial amount with Square Gift Cards](https://developer.squareup.com/docs/payments-api/take-payments#partial-payment-gift-card).<br><br>Default: false | getAcceptPartialAuthorization(): ?bool | setAcceptPartialAuthorization(?bool acceptPartialAuthorization): void |
| `buyerEmailAddress` | `?string` | Optional | The buyer's email address.<br>**Constraints**: *Maximum Length*: `255` | getBuyerEmailAddress(): ?string | setBuyerEmailAddress(?string buyerEmailAddress): void |
| `billingAddress` | [`?Address`](../../doc/models/address.md) | Optional | Represents a postal address in a country.<br>For more information, see [Working with Addresses](https://developer.squareup.com/docs/build-basics/working-with-addresses). | getBillingAddress(): ?Address | setBillingAddress(?Address billingAddress): void |
| `shippingAddress` | [`?Address`](../../doc/models/address.md) | Optional | Represents a postal address in a country.<br>For more information, see [Working with Addresses](https://developer.squareup.com/docs/build-basics/working-with-addresses). | getShippingAddress(): ?Address | setShippingAddress(?Address shippingAddress): void |
| `note` | `?string` | Optional | An optional note to be entered by the developer when creating a payment.<br>**Constraints**: *Maximum Length*: `500` | getNote(): ?string | setNote(?string note): void |
| `statementDescriptionIdentifier` | `?string` | Optional | Optional additional payment information to include on the customer's card statement<br>as part of the statement description. This can be, for example, an invoice number, ticket number,<br>or short description that uniquely identifies the purchase.<br><br>Note that the `statement_description_identifier` might get truncated on the statement description<br>to fit the required information including the Square identifier (SQ *) and name of the<br>seller taking the payment.<br>**Constraints**: *Maximum Length*: `20` | getStatementDescriptionIdentifier(): ?string | setStatementDescriptionIdentifier(?string statementDescriptionIdentifier): void |
| `cashDetails` | [`?CashPaymentDetails`](../../doc/models/cash-payment-details.md) | Optional | Stores details about a cash payment. Contains only non-confidential information. For more information, see<br>[Take Cash Payments](https://developer.squareup.com/docs/payments-api/take-payments/cash-payments). | getCashDetails(): ?CashPaymentDetails | setCashDetails(?CashPaymentDetails cashDetails): void |
| `externalDetails` | [`?ExternalPaymentDetails`](../../doc/models/external-payment-details.md) | Optional | Stores details about an external payment. Contains only non-confidential information.<br>For more information, see<br>[Take External Payments](https://developer.squareup.com/docs/payments-api/take-payments/external-payments). | getExternalDetails(): ?ExternalPaymentDetails | setExternalDetails(?ExternalPaymentDetails externalDetails): void |

## Example (as JSON)

```json
{
  "amount_money": {
    "amount": 1000,
    "currency": "USD"
  },
  "app_fee_money": {
    "amount": 10,
    "currency": "USD"
  },
  "autocomplete": true,
  "customer_id": "W92WH6P11H4Z77CTET0RNTGFW8",
  "idempotency_key": "7b0f3ec5-086a-4871-8f13-3c81b3875218",
  "location_id": "L88917AVBK2S5",
  "note": "Brief description",
  "reference_id": "123456",
  "source_id": "ccof:GaJGNaZa8x4OgDJn4GB",
  "tip_money": {
    "amount": 190,
    "currency": "ZMK"
  },
  "delay_duration": "delay_duration2",
  "delay_action": "delay_action0"
}
```
