import time
import sys


def loading_animation(message, duration=3):
    print(message, end="")
    for _ in range(duration):
        sys.stdout.write(".")
        sys.stdout.flush()
        time.sleep(0.5)
    print("\n")


pin = '1234'
balance = 10000
attempts = 3

while attempts > 0:
    try:
        user_pin = input('Enter your PIN: ')
        if user_pin != pin:
            raise ValueError('Incorrect PIN!')

        loading_animation("Verifying PIN")

        while True:
            print("\n1. Check Balance\n2. Withdraw\n3. Deposit\n4. Exit")
            option = input('Enter your choice: ')

            if option == '1':
                loading_animation("Fetching Balance", 2)
                print('Your balance is:', balance)

            elif option == '2':
                while True:
                    try:
                        amount = int(input('Enter amount to withdraw: '))
                        if amount > balance:
                            raise ValueError("Insufficient balance! Please enter a valid amount.")
                        break  # Valid amount, exit loop
                    except ValueError as e:
                        print(e)

                loading_animation("Processing Withdrawal", 2)
                balance -= amount
                print(f'Withdrawal successful! Your new balance is: {balance}')

            elif option == '3':
                try:
                    amount = int(input('Enter amount to deposit: '))
                    if amount <= 0:
                        raise ValueError("Deposit amount must be greater than 0.")
                    
                    loading_animation("Processing Deposit", 2)
                    balance += amount
                    print(f'Deposit successful! Your new balance is: {balance}')
                except ValueError as e:
                    print(e)

            elif option == '4':
                loading_animation("Exiting", 2)
                print("Thank you for using our ATM! Have a nice day! 😊")
                sys.exit()

            else:
                print('Invalid option! Please choose a valid number (1-4).')

    except ValueError as e:
        print(e)
        attempts -= 1
        print(f'Attempts left: {attempts}')
        if attempts == 0:
            loading_animation("Your card is blocked", 3)
            print("Please contact your bank.")
            break

    finally:
        time.sleep(1)  # Small delay to simulate a real ATM response
