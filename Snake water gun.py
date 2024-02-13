import random
print('Winning rules of the game SNAKE WATER GUN are :\n'
      + "Snake vs water -> Snake wins \n"
      + "Water  vs Gun -> Water wins \n"
      + "Gun vs Snake -> Gun wins \n")
while True:
    print("The choice are \n 1.Snake \n 2.Water \n 3. Gun")
    user_choice=int(input("Enter your choice:"))
    
    while user_choice > 3 or user_choice < 1:
        print(" Please Enter a valid choice:")

        if user_choice == 1 :
            user_choice_name= "Snake"
        elif user_choice == 2:
                user_choice_name = "Water"
        else:
            user_choice_name = "Gun"
            print("The choice you picked is :",user_choice_name)
            print(" Now It's My turn!!")

            com_choice = random.randint(1,3)
            while com_choice == user_choice:
                com_choice = random.randint(1,3)

                if com_choice == 1:
                    com_choice_name  = "Snake"
                elif com_choice == 2:
                    com_choice_name = "Water"
                else:
                    com_choice_name = "Gun"
                    print("My choice is :",com_choice_name)
                    print(user_choice_name,"VS", com_choice_name)


                    if user_choice == com_choice:
                        print("ITS  A DRAW ",end="")
                        result = "DRAW"
                    if user_choice == 1 and com_choice ==2:
                        print("SNAKE WINS",end="")
                        result = "SNAKE"
                    elif user_choice== 2 and com_choice == 1:
                        print("SNAKE WINS",end="")
                        result = "SNAKE"


                    if user_choice == 1 and com_choice == 3:
                        print("GUN WINS", end="")
                        result = "GUN"
                    elif user_choice == 3 and com_choice == 1:
                        print("GUN WINS", end="")
                        result = "GUN"

                    if user_choice == 2 and com_choice == 3:
                        print("WATER WINS", end="")
                        result = "WATER"
                    elif user_choice == 3 and com_choice == 2:
                        print("WATER WINS",end= "")
                        result = "WATER"

                    if result == "DRAW":
                        print("<-- Its a tie -->")
                    if result == user_choice_name:
                        print("<--YOU WIN-->")
                    else:
                        print("<-- HURRY I WIN -->")
                    print("Do you want to play again ?(Y/N)")
                    ans = input().lower
                    if ans == "n":
                        break
                        print("THANKS FOR PLAYING WITH ME")
'''



import random

print('Winning rules of the game SNAKE WATER GUN are :\n'
      + "Snake vs water -> Snake wins \n"
      + "Water  vs Gun -> Water wins \n"
      + "Gun vs Snake -> Gun wins \n")

while True:
    print("The choices are \n 1.Snake \n 2.Water \n 3. Gun")
    user_choice = int(input("Enter your choice:"))

    while user_choice > 3 or user_choice < 1:
        print("Please Enter a valid choice:")
        user_choice = int(input("Enter your choice:"))

    if user_choice == 1:
        user_choice_name = "Snake"
    elif user_choice == 2:
        user_choice_name = "Water"
    else:
        user_choice_name = "Gun"

    print("The choice you picked is:", user_choice_name)
    print("Now It's My turn!!")

    com_choice = random.randint(1, 3)
    while com_choice == user_choice:
        com_choice = random.randint(1, 3)

    if com_choice == 1:
        com_choice_name = "Snake"
    elif com_choice == 2:
        com_choice_name = "Water"
    else:
        com_choice_name = "Gun"

    print("My choice is:", com_choice_name)
    print(user_choice_name, "VS", com_choice_name)

    if user_choice == com_choice:
        print("IT'S A DRAW")
        result = "DRAW"
    elif (user_choice == 1 and com_choice == 2) or (user_choice == 2 and com_choice == 1):
        print("SNAKE WINS")
        result = "SNAKE"
    elif (user_choice == 1 and com_choice == 3) or (user_choice == 3 and com_choice == 1):
        print("GUN WINS")
        result = "GUN"
    elif (user_choice == 2 and com_choice == 3) or (user_choice == 3 and com_choice == 2):
        print("WATER WINS")
        result = "WATER"

    if result == "DRAW":
        print("<-- It's a tie -->")
    elif result == user_choice_name:
        print("<-- YOU WIN -->")
    else:
        print("<-- HURRY I WIN -->")

    print("Do you want to play again? (Y/N)")
    ans = input().lower()
    if ans == "n":
        print("THANKS FOR PLAYING WITH ME")
        break

