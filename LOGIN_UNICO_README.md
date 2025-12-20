# 🔐 Sistema de Login Único - ControleOS

## 📋 Resumo da Implementação

Foi implementado um sistema de login único que redireciona automaticamente cada usuário para sua área específica baseado no tipo de perfil (Administrador, Funcionário ou Técnico).

## 🌟 Características

### Tela de Login Única
**URL:** `http://localhost:9090/ControleOs/src/View/acesso/login.php`

- ✅ Design moderno com gradiente
- ✅ Máscara automática de CPF
- ✅ Validação de campos obrigatórios
- ✅ Mensagens de erro específicas
- ✅ Redirecionamento automático por perfil

### Redirecionamento Inteligente

O sistema identifica o tipo de usuário através do token JWT e redireciona automaticamente:

| Tipo | Perfil | URL de Destino |
|------|--------|----------------|
| 1 | Administrador | `http://localhost:9090/ControleOs/src/View/adm/consultar_usuario.php` |
| 2 | Funcionário | `http://localhost:9090/ControleOsFun/src/view/funcionario/chamados.php` |
| 3 | Técnico | `http://localhost:9090/ControleOsTec/src/view/tecnico/chamados.php` |

## 🔧 Arquivos Modificados

### Backend

**1. UsuarioCTRL.php** - Token com tipo de usuário
```php
$dados_usuario = [
    'cod_user' => $usuario['id'],
    'nome' => $usuario['nome_usuario'],
    'cod_setor' => $usuario['setor_id'],
    'tipo_usuario' => $usuario['tipo_usuario']  // ⭐ NOVO
];
```

### Frontend

**2. login_ajax.js** (ControleOs) - Lógica de redirecionamento
```javascript
switch (parseInt(tokenData.tipo_usuario)) {
    case TIPO_USUARIO_ADM:
        urlRedirect = URL_ADM;
        break;
    case TIPO_USUARIO_FUNCIONARIO:
        urlRedirect = URL_FUNCIONARIO;
        break;
    case TIPO_USUARIO_TECNICO:
        urlRedirect = URL_TECNICO;
        break;
}
```

**3. funcoes.js** - Logout unificado
```javascript
function sairSistema() {
  ClearTnk();
  window.location.href = 'http://localhost:9090/ControleOs/src/View/acesso/login.php';
}
```

**4. login_ajax.js** (ControleOsFun e ControleOsTec)
- Removida função `Logar()` (agora centralizada)
- Atualizada função `VerificarAutenticacao()` para redirecionar ao login único

## 🚀 Como Funciona

### Fluxo de Login

```
1. Usuário acessa: http://localhost:9090/ControleOs/src/View/acesso/login.php
   ↓
2. Digita CPF e senha
   ↓
3. Sistema chama ValidarLoginAPI
   ↓
4. Backend retorna token JWT com tipo_usuario
   ↓
5. JavaScript extrai tipo_usuario do token
   ↓
6. Redireciona automaticamente para:
   - Tipo 1 (ADM) → ControleOs/View/adm/
   - Tipo 2 (FUNC) → ControleOsFun/view/funcionario/
   - Tipo 3 (TEC) → ControleOsTec/view/tecnico/
```

### Fluxo de Logout

```
1. Usuário clica em "Sair do Sistema" (qualquer área)
   ↓
2. Sistema chama sairSistema()
   ↓
3. Limpa token do localStorage
   ↓
4. Redireciona para: http://localhost:9090/ControleOs/src/View/acesso/login.php
```

### Proteção de Páginas

```
1. Usuário tenta acessar página protegida sem token
   ↓
2. VerificarAutenticacao() detecta ausência/invalidade do token
   ↓
3. Redireciona para: http://localhost:9090/ControleOs/src/View/acesso/login.php
```

## 🎨 Interface

### Design da Tela de Login

- **Fundo:** Gradiente moderno (roxo/violeta)
- **Título:** "Sistema de Controle de Chamados"
- **Subtítulo:** "Acesso Unificado"
- **Campos:**
  - CPF (com máscara automática)
  - Senha (tipo password)
- **Botão:** "Entrar" (azul primário)
- **Feedback:** Mensagens toast coloridas

### Mensagens do Sistema

**Sucesso:**
```
✅ Bem-vindo, Administrador! Redirecionando...
✅ Bem-vindo, Funcionário! Redirecionando...
✅ Bem-vindo, Técnico! Redirecionando...
```

**Erro:**
```
❌ Por favor, preencha todos os campos.
❌ Usuário não encontrado ou inativo.
❌ CPF ou senha incorretos.
❌ Erro ao conectar com o servidor.
```

## 🧪 Teste Rápido

### 1. Teste de Login como Funcionário

```
1. Acesse: http://localhost:9090/ControleOs/src/View/acesso/login.php
2. Digite CPF de funcionário (tipo_usuario = 2)
3. Digite senha
4. Clique em "Entrar"
5. Aguarde redirecionamento para ControleOsFun
```

### 2. Teste de Login como Técnico

```
1. Acesse: http://localhost:9090/ControleOs/src/View/acesso/login.php
2. Digite CPF de técnico (tipo_usuario = 3)
3. Digite senha
4. Clique em "Entrar"
5. Aguarde redirecionamento para ControleOsTec
```

### 3. Teste de Logout

```
1. Estando logado em qualquer área
2. Clique no botão "Sair do Sistema" (menu lateral)
3. Verifique redirecionamento para login único
4. Tente voltar à página anterior
5. Deve redirecionar novamente para login
```

### 4. Verificar Token no Console

```javascript
// Ver token armazenado
console.log(localStorage.getItem('user_tkn'));

// Ver dados do token (incluindo tipo_usuario)
const token = localStorage.getItem('user_tkn');
const payload = JSON.parse(atob(token.split('.')[1]));
console.log(payload);
// Resultado esperado:
// {
//   cod_user: 2,
//   nome: "Nome do Usuário",
//   cod_setor: 1,
//   tipo_usuario: 2  // ⭐ NOVO
// }
```

## 🔒 Segurança

### Token JWT Completo

O token agora inclui:
- ✅ `cod_user`: ID do usuário
- ✅ `nome`: Nome do usuário
- ✅ `cod_setor`: Setor do usuário
- ✅ `tipo_usuario`: Tipo de perfil (1=ADM, 2=FUNC, 3=TEC) ⭐ **NOVO**

### Validações Implementadas

- ✅ Token válido (assinatura correta)
- ✅ Token com formato correto (3 partes)
- ✅ Propriedade do recurso (usuário só acessa próprios dados)
- ✅ Redirecionamento automático se não autenticado
- ✅ Logout limpa completamente o localStorage

## 📝 URLs Importantes

### Login Único (para todos os perfis)
```
http://localhost:9090/ControleOs/src/View/acesso/login.php
```

### Áreas de Cada Perfil

**Administrador:**
```
http://localhost:9090/ControleOs/src/View/adm/consultar_usuario.php
```

**Funcionário:**
```
http://localhost:9090/ControleOsFun/src/view/funcionario/chamados.php
```

**Técnico:**
```
http://localhost:9090/ControleOsTec/src/view/tecnico/chamados.php
```

## ✅ Checklist de Implementação

- [x] Token inclui tipo_usuario
- [x] Tela de login única criada
- [x] Login_ajax.js com redirecionamento por perfil
- [x] Função sairSistema() atualizada (ControleOsFun)
- [x] Função sairSistema() atualizada (ControleOsTec)
- [x] VerificarAutenticacao() redireciona para login único
- [x] Botões de logout redirecionam para login único
- [x] Design moderno aplicado
- [x] Mensagens de feedback implementadas
- [x] Máscara de CPF funcionando

## 🎯 Vantagens do Login Único

1. **UX Melhorada:** Usuário não precisa saber qual URL acessar
2. **Manutenção Simplificada:** Uma única tela para manter
3. **Segurança Centralizada:** Validações em um único ponto
4. **Redirecionamento Inteligente:** Cada perfil vai para sua área
5. **Logout Unificado:** Sempre volta para o mesmo lugar
6. **Branding Consistente:** Interface única para todos

## 🔄 Compatibilidade

- ✅ Funciona com usuários existentes
- ✅ Não quebra funcionalidades anteriores
- ✅ Token backward compatible (novos campos adicionados)
- ✅ URLs antigas podem continuar funcionando (não obrigatório usar)

## 📞 Suporte

**Implementado em:** 20/12/2025  
**Versão:** 2.0 - Login Único  
**Status:** ✅ Funcional e testado
