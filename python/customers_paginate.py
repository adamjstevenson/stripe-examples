import stripe
stripe.api_key = "sk_your_api_key"

customers = stripe.Customer.all(limit=100)

for customer in customers.data:
  print(customer.id)

while customers.has_more:
  customers = stripe.Customer.all(limit=100, starting_after=customers.data[-1])
  for customer in customers.data:
    print(customer.id)