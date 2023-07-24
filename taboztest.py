def calc_price(cost, profit_percentage):
    # Calculate the profit amount
    profit = cost * (profit_percentage / 100)
    
    # Calculate the selling price
    price = cost + profit
    
    return price
hu;;jh;h

cost = 46
profit_percentage = 10.5

price = calc_price(cost, profit_percentage)
print("Selling Price: $", price)
