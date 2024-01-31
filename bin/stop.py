import subprocess
import platform

def run_command(command, description=""):
    print(f"{description}... ", end='', flush=True)
    result = subprocess.run(command, stdout=subprocess.PIPE, stderr=subprocess.PIPE, shell=True, text=True)
    if result.returncode != 0:
        print(f"Error: {result.stderr.strip()}")
    else:
        print("Done")

docker_compose_command = 'docker-compose stop -t 1'

if platform.system() == 'Windows':
    run_command('powershell -Command ' + docker_compose_command, "Stopping containers")
else:
    run_command(docker_compose_command, "Stopping containers")

print("Docker containers stopped!")