import stripe
stripe.api_key = "sk_your_api_key"

charges = stripe.Charge.all(limit=100)

for charge in charges.data:
  print(charge.id)

while charges.has_more:
  charges = stripe.Charge.all(limit=100, starting_after=charges.data[-1])
  for charge in charges.data:
    print(charge.id)