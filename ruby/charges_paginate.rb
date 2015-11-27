require 'stripe'

Stripe.api_key = "sk_your_api_key"

charges = Stripe::Charge.all(:limit => 100)

charges.each do |charge|
  puts charge.id
end

while charges.has_more do 
  charges = Stripe::Charge.all(:limit => 100, :starting_after => charges.data.last.id)

  charges.each do |charge|
    puts charge.id
  end
end