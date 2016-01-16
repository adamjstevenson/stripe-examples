require 'stripe'

Stripe.api_key = "sk_your_api_key"

customers = Stripe::Customer.all(:limit => 100)

customers.each do |customer|
  puts customer.id
end

while customers.has_more do 
  customers = Stripe::Customer.all(:limit => 100, :starting_after => customers.data.last.id)

  customers.each do |customer|
    puts customer.id
  end
end