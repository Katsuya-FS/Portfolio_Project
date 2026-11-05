import { cp, mkdir } from 'node:fs/promises';
import { fileURLToPath } from 'node:url';

const PublicAssetsDirectory = fileURLToPath(new URL('../public/assets/', import.meta.url));
const DeploymentAssetsDirectory = fileURLToPath(new URL('../dist/assets/', import.meta.url));

await mkdir(DeploymentAssetsDirectory, { recursive: true });
await cp(PublicAssetsDirectory, DeploymentAssetsDirectory, { recursive: true, force: true });
