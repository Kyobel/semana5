from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

# Configuración del WebDriver
driver = webdriver.Firefox()
wait = WebDriverWait(driver, 10)

def test_crear_usuario():
    driver.get("http://localhost/sistemaventaboletos/index.php")
    wait.until(EC.presence_of_element_located((By.ID, "nombre"))).send_keys("Juan")
    driver.find_element(By.ID, "apellido").send_keys("Pérez")
    driver.find_element(By.ID, "correo").send_keys("juan.perez@example.com")
    driver.find_element(By.ID, "password").send_keys("contraseña123")
    driver.find_element(By.XPATH, "//form[@action='crearUsuario.php']/button").click()
    assert "Usuario creado con éxito" in driver.page_source

def test_crear_viaje():
    driver.get("http://localhost/sistemaventaboletos/index.php")
    wait.until(EC.presence_of_element_located((By.ID, "origen"))).send_keys("Ciudad A")
    driver.find_element(By.ID, "destino").send_keys("Ciudad B")
    driver.find_element(By.ID, "fecha").send_keys("2024-12-31")
    driver.find_element(By.ID, "hora").send_keys("10:00")
    driver.find_element(By.ID, "precio").send_keys("100.00")
    driver.find_element(By.ID, "cupoDisponible").send_keys("50")
    driver.find_element(By.XPATH, "//form[@action='viajes.php']/button").click()
    assert "Viaje creado con éxito" in driver.page_source

def test_crear_autobus():
    driver.get("http://localhost/sistemaventaboletos/index.php")
    wait.until(EC.presence_of_element_located((By.NAME, "numeroAutobus"))).send_keys("1234")
    driver.find_element(By.NAME, "capacidad").send_keys("40")
    driver.find_element(By.XPATH, "//form[@action='autobuses.php']/button").click()
    assert "Autobús creado con éxito" in driver.page_source

def test_crear_boleto():
    driver.get("http://localhost/sistemaventaboletos/index.php")
    
    wait.until(EC.presence_of_element_located((By.NAME, "idUsuario"))).send_keys("1")
    driver.find_element(By.NAME, "idAutobus").send_keys("1")
    
    viaje_select = driver.find_element(By.NAME, "idViaje")
    viaje_select.click()
    viaje_select.find_element(By.XPATH, "//option[@value='1']").click()
    
    descuento_select = driver.find_element(By.NAME, "idDescuento")
    descuento_select.click()
    descuento_select.find_element(By.XPATH, "//option[@value='1']").click()
    
    # Ejecutar el cálculo de descuento
    driver.execute_script("window.calcularDescuento();")
    
    # Espera explícita para que los campos se actualicen
    wait.until(EC.text_to_be_present_in_element_value((By.NAME, "montoTotal"), ""))
    wait.until(EC.text_to_be_present_in_element_value((By.NAME, "porcentajeDescuento"), ""))
    
    driver.find_element(By.NAME, "numeroAsiento").send_keys("5")
    driver.find_element(By.NAME, "fechaCompra").send_keys("2024-09-15")
    driver.find_element(By.NAME, "estadoBoleto").send_keys("Activo")
    
    monto_total_input = driver.find_element(By.NAME, "montoTotal")
    porcentaje_descuento_input = driver.find_element(By.NAME, "porcentajeDescuento")
    
    assert monto_total_input.get_attribute("value") != ""
    assert porcentaje_descuento_input.get_attribute("value") != ""

    driver.find_element(By.XPATH, "//form[@action='boletos.php']/button").click()
    assert "Boleto creado con éxito" in driver.page_source


# Ejecutar las pruebas
try:
    test_crear_usuario()
    test_crear_viaje()
    test_crear_autobus()
    test_crear_boleto()
finally:
    driver.quit()
