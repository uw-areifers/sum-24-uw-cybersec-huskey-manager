import subprocess
import platform

def run_command(command, description=""):
    print(f"{description}... ", end='', flush=True)
    result = subprocess.run(command, stdout=subprocess.PIPE, stderr=subprocess.PIPE, shell=True, text=True)
    if result.returncode != 0:
        print(f"Error: {result.stderr.strip()}")
    else:
        print("Done")

run_command('docker-compose stop -t 1', "Stopping and removing containers")
run_command('docker-compose rm -f', "Removing containers")

delete_volumes = input("Do you want to delete all volumes? (y/n): ").strip().lower()

if delete_volumes == 'y':
    run_command('docker-compose down -v', "Deleting volumes")
else:
    print("Volumes are not deleted.")

run_command('docker image prune -a -f', "Deleting images")

run_command('docker-compose pull', "Pulling images")

docker_compose_command = 'docker-compose -f docker-compose.yaml up --build -d'

if platform.system() == 'Windows':
    run_command('powershell -Command ' + docker_compose_command, "Rebuilding and redeploying containers")
else:
    run_command(docker_compose_command, "Rebuilding and redeploying containers")

print("Web app deployed!")
