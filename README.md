1. Entidade: Usuario

Descrição: Armazena informações dos usuários do sistema.

Campos:

id (int): Identificador único do usuário.

name (string): Nome do usuário.

password (string): Senha do usuário.

email (string): Email do usuário.

tipo(string): Tipo do usuário podem ser pessoas comum e produtores rurais.

cep (string, nullable): CEP do endereço do usuário.

bairro (string, nullable): Bairro do endereço do usuário.

numero (string, nullable): Número do endereço do usuário.

cidade (string, nullable): Cidade do usuário.

rua (string, nullable): Rua do endereço do usuário.

Campos adicionais:

cpf (bigint, nullable): CPF para pessoas comuns.

documento (string, nullable): Documento para produtores rurais.

2. Entidade: Placa

Descrição: Representa as placas solares no sistema.

Campos:

id (int): Identificador único da placa.

nome (string): Nome da placa.

valor (decimal): Valor da placa.

potencia (float): Potência da placa.

tamanho (int): Tamanho da placa.

quantidade (int): Quantidade disponível.

usuario_id (int, FK): Chave estrangeira referenciando o usuário.

3. Entidade: Kit

Descrição: Agrupa placas e geradores em kits.

Campos:

id (int): Identificador único do kit.

nome (string): Nome do kit.

valor (decimal): Valor do kit.

quantidade (int): Quantidade disponível.

placa_id (int, FK): Chave estrangeira referenciando a placa.

gerador_id (int, FK): Chave estrangeira referenciando o gerador.

4. Entidade: Gerador

Descrição: Representa geradores disponíveis no sistema.

Campos:

id (int): Identificador único do gerador.

nome (string): Nome do gerador.

tamanho (int): Tamanho do gerador.

potencia (float): Potência do gerador.

valor (decimal): Valor do gerador.

quantidade (int): Quantidade disponível.
