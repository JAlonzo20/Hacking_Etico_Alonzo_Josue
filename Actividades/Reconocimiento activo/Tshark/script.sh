#!/bin/bash

if [ $# -lt 2 ]; then
    echo "Uso: $0 <objetivo> <duración_en_segundos>"
    exit 1
fi

TARGET=$1
DURATION=$2

echo "==> Ejecutando nmap scan contra $TARGET..."
sudo nmap -sS -sV -oN nmap_result.txt "$TARGET"

echo "==> Iniciando captura de red durante $DURATION segundos (tshark)..."
timeout "$DURATION" tshark -i eth0 -w capture.pcap

echo "==> Captura finalizada. Abre 'capture.pcap' en Wireshark y aplica filtros para describir el tráfico observado."
