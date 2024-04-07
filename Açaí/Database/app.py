import mysql.connector
from time import sleep

conexao = mysql.connector.connect(

    host='localhost',
    user='root',
    password='',
    database='clientesite',
)

inicio = str(input('Deseja começar? [S/N] ')).upper().strip() [0]
if inicio == 'S':
    print(''' 
        [1] Fazer cadastro
        [2] Remover cadastro
        [3] Editar cadastro
        ''')
    acao = int(input('O que deseja fazer? '))
    while acao == 1:
        nome = str(input('Nome: '))
        adress = str(input('Endereço: '))
        tel = str(input('Número de Telefone: '))
        email = str(input('E-mail: '))
        password = str(input('Senha: '))
        comando = f'INSERT INTO clientes VALUES (default, "{nome}", "{adress}", "{tel}", "{email}", "{password}")'
        cursor = conexao.cursor()
        cursor.execute(comando)
        conexao.commit()
        sleep(2)
        print('Salvo com sucesso!')
        acao = str(input('Deseja cadastrar mais uma pessoa? [S/N] ')).upper().strip() [0]
        if acao == 'N':
            break
    while acao == 2:
        print('teste')
    while acao == 3:
        print('teste')
cursor.close()
conexao.close()
print('Cadastro finalizado com sucesso!')